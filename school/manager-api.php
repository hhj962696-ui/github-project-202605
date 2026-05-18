<?php
/**
 * 校園管理系統 - 管理頁面 API
 * 處理個人資料、班級資訊、成績查詢等數據請求
 */

header('Content-Type: application/json; charset=utf-8');

// 資料庫連接
$host = 'localhost';
$dbname = 'school';
$username = 'root';
$password = '';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;charset=$charset;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => '資料庫連接失敗']);
    exit;
}

// 獲取請求參數
$action = isset($_GET['action']) ? $_GET['action'] : '';
$cdkey = isset($_GET['cdkey']) ? $_GET['cdkey'] : '';

if (empty($action) || empty($cdkey)) {
    echo json_encode(['success' => false, 'message' => '參數不完整']);
    exit;
}

// 根據 action 執行不同的操作
switch ($action) {
    case 'profile':
        getProfile($pdo, $cdkey);
        break;
    case 'class':
        getClassInfo($pdo, $cdkey);
        break;
    case 'scores':
        getScores($pdo, $cdkey);
        break;
    default:
        echo json_encode(['success' => false, 'message' => '未知的操作']);
}

/**
 * 獲取個人資料
 */
function getProfile($pdo, $cdkey) {
    try {
        $sql = "SELECT m.id, m.cdkey, m.email, m.tel, m.birth 
                FROM member m 
                WHERE m.cdkey = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cdkey]);
        $memberData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$memberData) {
            echo json_encode(['success' => false, 'message' => '用戶不存在']);
            return;
        }
        
        $schoolNum = resolveSchoolNum($pdo, $cdkey);
        $studentData = [];

        if ($schoolNum) {
            $studentData = getStudentData($pdo, $schoolNum);
        }
        
        $result = [
            'cdkey' => $memberData['cdkey'],
            'email' => $memberData['email'] ?? '-',
            'tel' => $memberData['tel'] ?? '-',
            'birth' => $memberData['birth'] ?? '-',
            'school_num' => $schoolNum ?? '-',
            'class_name' => $studentData['class_name'] ?? '-',
            'dept_name' => $studentData['dept_name'] ?? ($studentData['dept'] ?? '-'),
            'enroll_year' => $studentData['year'] ?? '-'
        ];
        
        echo json_encode(['success' => true, 'data' => $result]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

/**
 * 獲取班級資訊
 */
function getClassInfo($pdo, $cdkey) {
    try {
        $schoolNum = resolveSchoolNum($pdo, $cdkey);
        if (!$schoolNum) {
            echo json_encode(['success' => false, 'message' => '無法關聯學生學號']);
            return;
        }

        $sql = "SELECT c.code, c.name, c.tutor
                FROM class_student cs
                JOIN classes c ON cs.class_code = c.code
                WHERE cs.school_num = ?
                LIMIT 1";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$schoolNum]);
        $classInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$classInfo) {
            echo json_encode(['success' => false, 'message' => '找不到班級資訊']);
            return;
        }

        $membersSql = "SELECT s.school_num, s.name, s.birthday, s.tel, s.dept
                       FROM students s
                       JOIN class_student cs ON s.school_num = cs.school_num
                       WHERE cs.class_code = ?
                       ORDER BY s.school_num ASC
                       LIMIT 50";
        
        $stmt = $pdo->prepare($membersSql);
        $stmt->execute([$classInfo['code']]);
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [
            'class_name' => $classInfo['name'],
            'teacher' => $classInfo['tutor'],
            'members' => array_map(function($member) {
                return [
                    'school_num' => $member['school_num'],
                    'name' => $member['name'],
                    'gender' => '-',
                    'birth' => $member['birthday'] ?? '-',
                    'phone' => $member['tel'] ?? '-'
                ];
            }, $members)
        ];
        
        echo json_encode(['success' => true, 'data' => $result]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

/**
 * 獲取成績信息
 */
function getScores($pdo, $cdkey) {
    try {
        $schoolNum = resolveSchoolNum($pdo, $cdkey);
        if (!$schoolNum) {
            echo json_encode(['success' => false, 'message' => '無法關聯學生學號']);
            return;
        }

        $scoresSql = "SELECT ss.school_num, ss.score
                      FROM student_scores ss
                      WHERE ss.school_num = ?";
        
        $stmt = $pdo->prepare($scoresSql);
        $stmt->execute([$schoolNum]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        $courses = [];
        $average = 0;
        $highest = 0;
        $lowest = 0;

        if ($record) {
            $score = (int)$record['score'];
            $courses[] = [
                'course_code' => 'TOTAL',
                'course_name' => '總成績',
                'credit' => '-',
                'score' => $score
            ];
            $average = $score;
            $highest = $score;
            $lowest = $score;
        }

        $result = [
            'average' => $average,
            'highest' => $highest,
            'lowest' => $lowest,
            'courses' => $courses
        ];
        
        echo json_encode(['success' => true, 'data' => $result]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function resolveSchoolNum($pdo, $cdkey) {
    if (is_numeric($cdkey)) {
        $sql = "SELECT school_num FROM students WHERE school_num = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cdkey]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['school_num'];
        }
    }

    $sql = "SELECT m.cdkey, s.school_num 
            FROM member m
            JOIN students s ON m.cdkey = s.school_num
            WHERE m.cdkey = ?
            LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cdkey]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['school_num'] ?? null;
}

function getStudentData($pdo, $schoolNum) {
    $sql = "SELECT s.school_num, s.name, s.birthday, s.tel, s.dept, cs.class_code, cs.year 
            FROM students s
            LEFT JOIN class_student cs ON s.school_num = cs.school_num
            WHERE s.school_num = ?
            LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$schoolNum]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
}

?>

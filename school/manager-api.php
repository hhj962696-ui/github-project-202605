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
        // 查詢 member 表
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
        
        // 根據 cdkey 查詢學生信息（假設 students 表中有對應記錄）
        // 這裡需要確定如何將 member 和 students 關聯
        // 可能需要在 students 表中增加 member_id 或 cdkey 字段
        $studentData = getStudentByMember($pdo, $memberData['id']);
        
        $result = [
            'cdkey' => $memberData['cdkey'],
            'email' => $memberData['email'] ?? '-',
            'tel' => $memberData['tel'] ?? '-',
            'birth' => $memberData['birth'] ?? '-',
            'school_num' => $studentData['school_num'] ?? '-',
            'class_name' => $studentData['class_name'] ?? '-',
            'dept_name' => $studentData['dept_name'] ?? '-',
            'enroll_year' => $studentData['enroll_year'] ?? '-'
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
        // 獲取第一個班級作為示例（實際應該通過會員與學生的關聯查詢）
        $sql = "SELECT DISTINCT c.id, c.class_id, c.class_name, c.grade_year
                FROM classes c
                LIMIT 1";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $classInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$classInfo || empty($classInfo['id'])) {
            echo json_encode(['success' => true, 'data' => [
                'class_name' => '未分配',
                'members' => [],
                'teacher' => '未安排'
            ]]);
            return;
        }
        
        // 獲取班級成員
        $membersSql = "SELECT s.id, s.school_num, s.name, 
                              CASE 
                                WHEN s.uni_id LIKE '%M' THEN 'M'
                                WHEN s.uni_id LIKE '%F' THEN 'F'
                                ELSE 'U'
                              END as gender,
                              s.birthday as birth, 
                              s.tel as phone
                       FROM students s
                       LEFT JOIN class_student cs ON s.school_num = cs.school_num
                       WHERE cs.class_id = ? OR 1=1
                       ORDER BY s.school_num ASC
                       LIMIT 30";
        
        $stmt = $pdo->prepare($membersSql);
        $stmt->execute([$classInfo['class_id']]);
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result = [
            'class_name' => $classInfo['class_name'] ?? '-',
            'teacher' => '班導師',
            'members' => $members
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
        // 獲取第一個學生的成績作為示例
        $sql = "SELECT DISTINCT s.school_num 
                FROM students s
                LIMIT 1";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $studentInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$studentInfo) {
            echo json_encode(['success' => true, 'data' => [
                'average' => 0,
                'highest' => 0,
                'lowest' => 0,
                'courses' => []
            ]]);
            return;
        }
        
        $schoolNum = $studentInfo['school_num'];
        
        // 查詢成績信息
        $scoresSql = "SELECT ss.school_num, 
                            ss.course_code, 
                            ss.course_name, 
                            ss.credit, 
                            ss.score
                      FROM student_scores ss
                      WHERE ss.school_num = ?
                      ORDER BY ss.course_code ASC";
        
        $stmt = $pdo->prepare($scoresSql);
        $stmt->execute([$schoolNum]);
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // 計算統計數據
        $totalScore = 0;
        $totalCourses = count($courses);
        $highest = 0;
        $lowest = 100;
        
        if ($totalCourses > 0) {
            foreach ($courses as $course) {
                $score = (float)$course['score'];
                $totalScore += $score;
                $highest = max($highest, $score);
                $lowest = min($lowest, $score);
            }
        }
        
        $average = $totalCourses > 0 ? $totalScore / $totalCourses : 0;
        
        $result = [
            'average' => round($average, 1),
            'highest' => (int)$highest,
            'lowest' => $totalCourses > 0 ? (int)$lowest : 0,
            'courses' => $courses
        ];
        
        echo json_encode(['success' => true, 'data' => $result]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

/**
 * 根據 member ID 獲取學生信息
 */
function getStudentByMember($pdo, $memberId) {
    // 由於設計中可能沒有直接的 member_id 關聯，
    // 這裡先返回空數組，實際需要根據業務邏輯調整
    return [];
}

?>

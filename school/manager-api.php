<?php
/**
 * 校園管理系統 - 管理頁面 API
 * 處理個人資料、班級資訊、成績查詢等數據請求
 */

header('Content-Type: application/json; charset=utf-8');

// 資料庫連接 - mypage (會員資料)
$host = 'localhost';
$username = 'root';
$password = '';
$charset = 'utf8mb4';

try {
    $pdoMypage = new PDO("mysql:host=$host;charset=$charset;dbname=mypage", $username, $password);
    $pdoMypage->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'mypage 資料庫連接失敗']);
    exit;
}

// 資料庫連接 - school 資料（學生、班級、成績也在 mypage 庫中）
try {
    $pdoSchool = new PDO("mysql:host=$host;charset=$charset;dbname=mypage", $username, $password);
    $pdoSchool->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => '學校資料庫連接失敗']);
    exit;
}

// 獲取請求參數
$action = isset($_GET['action']) ? $_GET['action'] : '';
$cdkey = isset($_GET['cdkey']) ? $_GET['cdkey'] : '';

if (empty($action)) {
    echo json_encode(['success' => false, 'message' => '參數不完整']);
    exit;
}

// classlist 和 classmembers 不需要 cdkey
if (!in_array($action, ['classlist', 'classmembers', 'classscores']) && empty($cdkey)) {
    echo json_encode(['success' => false, 'message' => '參數不完整']);
    exit;
}

// 根據 action 執行不同的操作
switch ($action) {
    case 'profile':
        getProfile($pdoMypage, $pdoSchool, $cdkey);
        break;
    case 'class':
        getClassInfo($pdoMypage, $pdoSchool, $cdkey);
        break;
    case 'scores':
        getScores($pdoMypage, $pdoSchool, $cdkey);
        break;
    case 'classlist':
        getClassList($pdoSchool);
        break;
    case 'classmembers':
        $classCode = isset($_GET['class_code']) ? $_GET['class_code'] : '';
        if (empty($classCode)) {
            echo json_encode(['success' => false, 'message' => '請提供班級代碼']);
        } else {
            getClassMembers($pdoSchool, $classCode);
        }
        break;
    case 'classscores':
        $classCode = isset($_GET['class_code']) ? $_GET['class_code'] : '';
        if (empty($classCode)) {
            echo json_encode(['success' => false, 'message' => '請提供班級代碼']);
        } else {
            getClassScores($pdoSchool, $classCode);
        }
        break;
    default:
        echo json_encode(['success' => false, 'message' => '未知的操作']);
}

/**
 * 獲取個人資料
 */
function getProfile($pdoMypage, $pdoSchool, $cdkey) {
    try {
        // 從 mypage.member 查詢會員資料
        $sql = "SELECT m.id, m.cdkey, m.email, m.tel, m.birth 
                FROM member m 
                WHERE m.cdkey = ?";
        
        $stmt = $pdoMypage->prepare($sql);
        $stmt->execute([$cdkey]);
        $memberData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$memberData) {
            echo json_encode(['success' => false, 'message' => '用戶不存在']);
            return;
        }
        
        // 從 school.students 查詢學籍資料
        $schoolNum = resolveSchoolNum($pdoMypage, $pdoSchool, $cdkey);
        $studentData = [];

        if ($schoolNum) {
            $studentData = getStudentData($pdoSchool, $schoolNum);
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
function getClassInfo($pdoMypage, $pdoSchool, $cdkey) {
    try {
        $schoolNum = resolveSchoolNum($pdoMypage, $pdoSchool, $cdkey);
        if (!$schoolNum) {
            echo json_encode(['success' => false, 'message' => '無法關聯學生學號']);
            return;
        }

        $sql = "SELECT c.code, c.name, c.tutor
                FROM class_student cs
                JOIN classes c ON cs.class_code = c.code
                WHERE cs.school_num = ?
                LIMIT 1";
        
        $stmt = $pdoSchool->prepare($sql);
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
        
        $stmt = $pdoSchool->prepare($membersSql);
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
 * 注意：目前資料庫中沒有 student_scores 表，暫時回傳空資料
 */
function getScores($pdoMypage, $pdoSchool, $cdkey) {
    try {
        $schoolNum = resolveSchoolNum($pdoMypage, $pdoSchool, $cdkey);
        if (!$schoolNum) {
            echo json_encode(['success' => false, 'message' => '無法關聯學生學號，請確認帳號與學號的對應關係']);
            return;
        }

        // 嘗試查詢 student_scores 表，如果不存在則回傳空資料
        $courses = [];
        $average = 0;
        $highest = 0;
        $lowest = 0;

        try {
            $scoresSql = "SELECT ss.school_num, ss.score
                          FROM student_scores ss
                          WHERE ss.school_num = ?";
            $stmt = $pdoSchool->prepare($scoresSql);
            $stmt->execute([$schoolNum]);
            $record = $stmt->fetch(PDO::FETCH_ASSOC);

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
        } catch (Exception $e) {
            // student_scores 表可能不存在，忽略錯誤
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

/**
 * 解析 cdkey 對應的學號
 * 策略：
 * 1. 如果 cdkey 本身就是數字且在 students 表中存在，直接使用
 * 2. 從 member 表取得 cdkey 對應的資料，嘗試用姓名或其他欄位匹配 students
 */
function resolveSchoolNum($pdoMypage, $pdoSchool, $cdkey) {
    // 策略1: cdkey 本身就是學號
    if (is_numeric($cdkey)) {
        $sql = "SELECT school_num FROM students WHERE school_num = ? LIMIT 1";
        $stmt = $pdoSchool->prepare($sql);
        $stmt->execute([$cdkey]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['school_num'];
        }
    }

    // 策略2: 從 member 表取姓名，再到 students 表比對
    // （如果 member 表有 name 欄位的話）
    try {
        $sql = "SELECT cdkey, email, tel FROM member WHERE cdkey = ? LIMIT 1";
        $stmt = $pdoMypage->prepare($sql);
        $stmt->execute([$cdkey]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($member) {
            // 嘗試用 cdkey 直接當作姓名搜尋
            $sql2 = "SELECT school_num FROM students WHERE name = ? LIMIT 1";
            $stmt2 = $pdoSchool->prepare($sql2);
            $stmt2->execute([$cdkey]);
            $row = $stmt2->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row['school_num'];
            }
            
            // 嘗試用電話號碼匹配
            if (!empty($member['tel'])) {
                $sql3 = "SELECT school_num FROM students WHERE tel = ? LIMIT 1";
                $stmt3 = $pdoSchool->prepare($sql3);
                $stmt3->execute([$member['tel']]);
                $row = $stmt3->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    return $row['school_num'];
                }
            }
        }
    } catch (Exception $e) {
        // 比對失敗，回傳 null
    }

    return null;
}

function getStudentData($pdoSchool, $schoolNum) {
    $sql = "SELECT s.school_num, s.name, s.birthday, s.tel, s.dept, cs.class_code, cs.year 
            FROM students s
            LEFT JOIN class_student cs ON s.school_num = cs.school_num
            WHERE s.school_num = ?
            LIMIT 1";
    $stmt = $pdoSchool->prepare($sql);
    $stmt->execute([$schoolNum]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
}

/**
 * 獲取所有班級列表
 */
function getClassList($pdo) {
    try {
        $sql = "SELECT c.code, c.name, c.tutor, 
                       (SELECT COUNT(*) FROM class_student cs WHERE cs.class_code = c.code) as student_count
                FROM classes c 
                ORDER BY c.code ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode(['success' => true, 'data' => $classes]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

/**
 * 根據班級代碼獲取全班學生詳細資訊（含住址、電話）
 */
function getClassMembers($pdo, $classCode) {
    try {
        // 先取得班級資訊
        $classSql = "SELECT code, name, tutor FROM classes WHERE code = ?";
        $stmt = $pdo->prepare($classSql);
        $stmt->execute([$classCode]);
        $classInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$classInfo) {
            echo json_encode(['success' => false, 'message' => '找不到該班級']);
            return;
        }
        
        // 取得全班學生含住址與電話
        $membersSql = "SELECT s.school_num, s.name, s.birthday, s.addr, s.tel, s.parents, s.dept,
                              cs.seat_num
                       FROM students s
                       JOIN class_student cs ON s.school_num = cs.school_num
                       WHERE cs.class_code = ?
                       ORDER BY cs.seat_num ASC";
        $stmt = $pdo->prepare($membersSql);
        $stmt->execute([$classCode]);
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // 查科系名稱對照
        $deptSql = "SELECT code, name FROM dept";
        $stmtDept = $pdo->prepare($deptSql);
        $stmtDept->execute();
        $depts = [];
        while ($row = $stmtDept->fetch(PDO::FETCH_ASSOC)) {
            $depts[$row['code']] = $row['name'];
        }
        
        $result = [
            'class_code' => $classInfo['code'],
            'class_name' => $classInfo['name'],
            'tutor' => $classInfo['tutor'],
            'total' => count($members),
            'members' => array_map(function($m) use ($depts) {
                return [
                    'school_num' => $m['school_num'],
                    'name' => $m['name'],
                    'birthday' => $m['birthday'] ?? '-',
                    'addr' => $m['addr'] ?? '-',
                    'tel' => $m['tel'] ?? '-',
                    'parents' => $m['parents'] ?? '-',
                    'seat_num' => $m['seat_num'],
                    'dept_name' => isset($depts[$m['dept']]) ? $depts[$m['dept']] : ($m['dept'] ?? '-')
                ];
            }, $members)
        ];
        
        echo json_encode(['success' => true, 'data' => $result]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

/**
 * 根據班級查詢全班成績（老師/管理員用）
 */
function getClassScores($pdoSchool, $classCode) {
    try {
        // 取得班級資訊
        $classSql = "SELECT code, name, tutor FROM classes WHERE code = ?";
        $stmt = $pdoSchool->prepare($classSql);
        $stmt->execute([$classCode]);
        $classInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$classInfo) {
            echo json_encode(['success' => false, 'message' => '找不到該班級']);
            return;
        }

        // 查詢全班學生，嘗試 LEFT JOIN student_scores
        $members = [];
        try {
            $sql = "SELECT s.school_num, s.name, s.dept, cs.seat_num,
                           ss.score
                    FROM students s
                    JOIN class_student cs ON s.school_num = cs.school_num
                    LEFT JOIN student_scores ss ON s.school_num = ss.school_num
                    WHERE cs.class_code = ?
                    ORDER BY cs.seat_num ASC";
            $stmt = $pdoSchool->prepare($sql);
            $stmt->execute([$classCode]);
            $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // student_scores 表不存在，只查學生基本資料
            $sql = "SELECT s.school_num, s.name, s.dept, cs.seat_num
                    FROM students s
                    JOIN class_student cs ON s.school_num = cs.school_num
                    WHERE cs.class_code = ?
                    ORDER BY cs.seat_num ASC";
            $stmt = $pdoSchool->prepare($sql);
            $stmt->execute([$classCode]);
            $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // 科系對照
        $deptSql = "SELECT code, name FROM dept";
        $stmtDept = $pdoSchool->prepare($deptSql);
        $stmtDept->execute();
        $depts = [];
        while ($row = $stmtDept->fetch(PDO::FETCH_ASSOC)) {
            $depts[$row['code']] = $row['name'];
        }

        // 統計
        $scores = [];
        foreach ($members as $m) {
            if (isset($m['score']) && $m['score'] !== null) {
                $scores[] = (int)$m['score'];
            }
        }
        $avg = count($scores) > 0 ? round(array_sum($scores) / count($scores), 1) : 0;
        $highest = count($scores) > 0 ? max($scores) : 0;
        $lowest = count($scores) > 0 ? min($scores) : 0;
        $passCount = count(array_filter($scores, fn($s) => $s >= 60));
        $failCount = count(array_filter($scores, fn($s) => $s < 60));

        $result = [
            'class_code' => $classInfo['code'],
            'class_name' => $classInfo['name'],
            'tutor' => $classInfo['tutor'],
            'total' => count($members),
            'average' => $avg,
            'highest' => $highest,
            'lowest' => $lowest,
            'pass_count' => $passCount,
            'fail_count' => $failCount,
            'has_scores' => count($scores) > 0,
            'members' => array_map(function($m) use ($depts) {
                return [
                    'school_num' => $m['school_num'],
                    'name' => $m['name'],
                    'seat_num' => $m['seat_num'],
                    'score' => $m['score'] ?? null,
                    'dept_name' => isset($depts[$m['dept']]) ? $depts[$m['dept']] : ($m['dept'] ?? '-')
                ];
            }, $members)
        ];

        echo json_encode(['success' => true, 'data' => $result]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

?>

<?php
// api_get_next_school_num.php - returns next 3‑digit suffix for a given class_code
require_once __DIR__ . '/db_conn.php';
header('Content-Type: application/json; charset=utf-8');

$class_code = isset($_GET['class_code']) ? $_GET['class_code'] : '';
if ($class_code === '') {
    echo json_encode(['error' => 'Missing class_code']);
    exit;
}

try {
    // 1. Find the maximum existing school_num for this class
    $stmt = $pdo->prepare(
        "SELECT MAX(`school_num`) AS max_num FROM `class_student` WHERE `class_code` = ?"
    );
    $stmt->execute([$class_code]);
    $maxNum = $stmt->fetchColumn(); // may be string like '101025'

    // 2. Extract the last three digits (suffix) and compute next suffix
    if ($maxNum) {
        $suffix = (int)substr($maxNum, -3);
        $nextSuffix = $suffix + 1;
        // keep within 3‑digit range, pad with leading zeros
        $nextSuffixStr = str_pad($nextSuffix, 3, '0', STR_PAD_LEFT);
        // also keep the prefix (everything except last 3 chars)
        $prefix = substr($maxNum, 0, -3);
    } else {
        // no existing record for this class
        $prefix = '';
        $nextSuffixStr = '001';
    }

    // 3. Retrieve the student name that holds the current max number (if any)
    $maxStudentName = '';
    if ($maxNum) {
        $studentStmt = $pdo->prepare(
            "SELECT s.`name` FROM `students` s
             JOIN `class_student` cs ON s.`school_num` = cs.`school_num`
             WHERE cs.`class_code` = ? AND cs.`school_num` = ?"
        );
        $studentStmt->execute([$class_code, $maxNum]);
        $maxStudentName = $studentStmt->fetchColumn();
    }

    // 4. Build full suggested school_num (prefix + next suffix)
    $suggested = $prefix . $nextSuffixStr;

    echo json_encode([
        'max_school_num'   => $maxNum ?: null,
        'max_suffix'       => $maxNum ? substr($maxNum, -3) : null,
        'max_student_name'=> $maxStudentName ?: null,
        'next_suffix'      => $nextSuffixStr,
        'suggested_school_num' => $suggested
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>

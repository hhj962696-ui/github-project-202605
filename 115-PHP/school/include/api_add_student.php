<?php
include "include/db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Prepare values from $_POST
    $school_num  = isset($_POST['school_num']) ? $_POST['school_num'] : '';
    $name        = isset($_POST['name']) ? $_POST['name'] : '';
    $birthday    = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $uni_id      = isset($_POST['uni_id']) ? $_POST['uni_id'] : '';
    $addr        = isset($_POST['addr']) ? $_POST['addr'] : '';
    $parents     = isset($_POST['parents']) ? $_POST['parents'] : '';
    $tel         = isset($_POST['tel']) ? $_POST['tel'] : '';
    $dept        = isset($_POST['dept']) ? $_POST['dept'] : '';
    $graduate_at = isset($_POST['graduate_at']) ? $_POST['graduate_at'] : '';
    $status_code = isset($_POST['status_code']) ? $_POST['status_code'] : '';
    $class_code  = isset($_POST['class_code']) ? $_POST['class_code'] : '';

    try {
        // Start transaction
        $pdo->beginTransaction();

        // 2. Insert into students table
        $sql = "INSERT INTO `students` (`school_num`, `name`, `birthday`, `uni_id`, `addr`, `parents`, `tel`, `dept`, `graduate_at`, `status_code`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $school_num,
            $name,
            $birthday,
            $uni_id,
            $addr,
            $parents,
            $tel,
            $dept,
            $graduate_at,
            $status_code
        ]);

        // 3. If class_code is provided, map student to class_student table
        if (!empty($class_code) && !empty($school_num)) {
            // Find next seat number in this class
            $seat_stmt = $pdo->prepare("SELECT MAX(CAST(`seat_num` AS UNSIGNED)) FROM `class_student` WHERE `class_code` = ?");
            $seat_stmt->execute([$class_code]);
            $max_seat = $seat_stmt->fetchColumn();
            $next_seat = $max_seat ? ($max_seat + 1) : 1;

            // Insert mapping row into class_student
            $class_sql = "INSERT INTO `class_student` (`school_num`, `class_code`, `seat_num`, `year`) VALUES (?, ?, ?, '2000')";
            $class_stmt = $pdo->prepare($class_sql);
            $class_stmt->execute([
                $school_num,
                $class_code,
                $next_seat
            ]);
        }

        // Commit transaction
        $pdo->commit();

        // Redirect back to either the specific class list or the admin classrooms dashboard
        if (!empty($class_code)) {
            header("Location: admin.php?inc=class_students&code=" . urlencode($class_code));
        } else {
            header("Location: admin.php?inc=classrooms");
        }
        exit;

    } catch (Exception $e) {
        // Rollback if anything failed
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        die("新增學生失敗：" . $e->getMessage());
    }
} else {
    // Direct access not allowed, redirect to classrooms
    header("Location: admin.php?inc=classrooms");
    exit;
}
?>

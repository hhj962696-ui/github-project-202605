<?php
/**
 * 校園管理系統 - 登入 API
 * 處理用戶登入驗證
 */

header('Content-Type: application/json; charset=utf-8');

// 資料庫連接
$host = 'localhost';
$dbname = 'mypage';
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

// 檢查請求方法
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => '無效的請求方法']);
    exit;
}

// 獲取 POST 數據
$cdkey = isset($_POST['cdkey']) ? trim($_POST['cdkey']) : '';
$inputPassword = isset($_POST['password']) ? $_POST['password'] : '';

// 驗證輸入
if (empty($cdkey) || empty($inputPassword)) {
    echo json_encode(['success' => false, 'message' => '帳號或密碼不能為空']);
    exit;
}

try {
    // 使用預準備語句查詢用戶
    $sql = "SELECT id, cdkey, password, email, tel FROM member WHERE cdkey = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cdkey]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 驗證密碼
    if ($user && $inputPassword === $user['password']) {
        // 登入成功 - 建立 Session
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['cdkey'] = $user['cdkey'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['login_time'] = time();

        echo json_encode([
            'success' => true,
            'message' => '登入成功',
            'data' => [
                'cdkey' => $user['cdkey'],
                'email' => $user['email'],
                'redirect' => 'manager.php'
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => '帳號或密碼錯誤']);
        header("location:login.php?err=1");
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => '資料庫查詢失敗']);
}

?>

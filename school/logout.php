<?php
/**
 * 校園管理系統 - 登出頁面
 * 清除會話信息並返回登入頁面
 */

// 開始 Session
session_start();

// 清除 Session 資料
$_SESSION = array();

// 清除 Session Cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// 銷毀 Session
session_destroy();

// 返回 JSON 響應或重導向
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // 重導向到登入頁面
    header("Location: login.php");
    exit;
} else {
    // 返回 JSON 響應
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => true, 'message' => '登出成功']);
    exit;
}

?>

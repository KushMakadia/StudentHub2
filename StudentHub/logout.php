<?php
require_once 'db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    log_audit($conn, $_SESSION['user_id'], 'USER_LOGOUT', 'User logged out');
}

$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
header("Location: Login.html?success=Logged out successfully");
exit();
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$timeout_duration = 900; 

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: Login.html?error=Session timed out. Please login again.");
    exit();
}
$_SESSION['last_activity'] = time();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.html?error=Unauthorized access. Please login.");
    exit();
}

function checkAdminRole() {
    if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
        header("Location: Dashboard.php?error=Access denied: Admins only.");
        exit();
    }
}
?>
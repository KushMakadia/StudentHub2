<?php
$conn = new mysqli("localhost", "root", "", "studenthub");
if ($conn->connect_error)
    die("Database connection failed: " . $conn->connect_error);
$conn->set_charset("utf8mb4");
if (session_status() === PHP_SESSION_NONE)
    session_start();
function h($x)
{
    return htmlspecialchars((string) $x, ENT_QUOTES, 'UTF-8');
}
function admin_only()
{
    if (empty($_SESSION['id']) || ($_SESSION['role'] ?? '') !== 'admin')
        die('Admin login required. <a href="login.php">Login</a>');
}
?>
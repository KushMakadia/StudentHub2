<?php
require_once 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        header("Location: Login.html?error=Email and Password are required");
        exit();
    }

    $stmt = $conn->prepare("SELECT student_id, name, email, password_hash, role FROM students WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['student_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['last_activity'] = time();

            log_audit($conn, $user['student_id'], 'USER_LOGIN', "User logged in with role: " . $user['role']);

            if (strtolower($user['role']) == 'admin') {
                header("Location: Admin.php");
            } else {
                header("Location: Profile.php");
            }
            exit();
        }
    }

    header("Location: Login.html?error=Invalid email or password");
    exit();
}
?>
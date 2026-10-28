<?php
require_once 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $mobile   = trim($_POST['mobile'] ?? '');
    $password = $_POST['password'] ?? '';
    $course   = trim($_POST['course'] ?? '');
    $year     = intval($_POST['year'] ?? 1);
    $gender   = trim($_POST['gender'] ?? 'Other');
    $role     = trim($_POST['role'] ?? 'student');

    if (empty($name) || empty($email) || empty($password) || empty($mobile)) {
        header("Location: Register.html?error=Please fill all required fields");
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: Register.html?error=Invalid email address");
        exit();
    }

    $check_stmt = $conn->prepare("SELECT student_id FROM students WHERE email = ? LIMIT 1");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $check_stmt->close();
        header("Location: Register.html?error=Email is already registered");
        exit();
    }
    $check_stmt->close();

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $insert_stmt = $conn->prepare(
        "INSERT INTO students (name, email, mobile, password_hash, course, year, gender, role) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $insert_stmt->bind_param("sssssiss", $name, $email, $mobile, $password_hash, $course, $year, $gender, $role);

    if ($insert_stmt->execute()) {
        $new_id = $insert_stmt->insert_id;
        log_audit($conn, $new_id, 'USER_REGISTERED', "Account created for email: $email");
        header("Location: Login.html?success=Registration successful. Please login.");
    } else {
        header("Location: Register.html?error=Registration failed: " . urlencode($insert_stmt->error));
    }
    $insert_stmt->close();
}
?>
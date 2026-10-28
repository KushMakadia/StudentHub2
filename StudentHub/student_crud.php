<?php
require_once 'db.php';
require_once 'auth_check.php';
checkAdminRole();

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM students WHERE student_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        log_audit($conn, $_SESSION['user_id'], 'DELETE_STUDENT', "Deleted student_id: $id");
        header("Location: Admin.php?success=Student deleted successfully");
    } else {
        header("Location: Admin.php?error=Failed to delete student");
    }
    $stmt->close();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = isset($_POST['student_id']) ? intval($_POST['student_id']) : 0;
    $name       = trim($_POST['name']);
    $email      = trim($_POST['email']);
    $mobile     = trim($_POST['mobile']);
    $course     = trim($_POST['course']);
    $year       = intval($_POST['year']);
    $gender     = trim($_POST['gender']);
    $role       = trim($_POST['role']);

    if ($student_id > 0) {
        $stmt = $conn->prepare("UPDATE students SET name=?, email=?, mobile=?, course=?, year=?, gender=?, role=? WHERE student_id=?");
        $stmt->bind_param("ssssissi", $name, $email, $mobile, $course, $year, $gender, $role, $student_id);
        $stmt->execute();
        log_audit($conn, $_SESSION['user_id'], 'UPDATE_STUDENT', "Updated student_id: $student_id");
        header("Location: Admin.php?success=Student record updated");
    } else {
        $default_pwd = password_hash("Default@123", PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO students (name, email, mobile, password_hash, course, year, gender, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssiss", $name, $email, $mobile, $default_pwd, $course, $year, $gender, $role);
        $stmt->execute();
        log_audit($conn, $_SESSION['user_id'], 'ADD_STUDENT', "Added student with email: $email");
        header("Location: Admin.php?success=Student record created");
    }
    $stmt->close();
    exit();
}
?>
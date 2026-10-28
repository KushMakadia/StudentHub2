<?php
$host = "localhost";
$dbname = "studenthub";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (!function_exists('log_audit')) {
    function log_audit($conn, $student_id, $action, $details) {
        $stmt = $conn->prepare("INSERT INTO audit_logs (student_id, action, details) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $student_id, $action, $details);
        $stmt->execute();
        $stmt->close();
    }
}
?>
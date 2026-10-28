<?php
require_once 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.html?error=Please login first to register for events.");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = intval($_SESSION['user_id']);
    $event_id   = intval($_POST['event_id']);

    $check = $conn->prepare("SELECT id FROM registrations WHERE student_id = ? AND event_id = ? LIMIT 1");
    $check->bind_param("ii", $student_id, $event_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $check->close();
        header("Location: Events.php?error=You are already registered for this event.");
        exit();
    }
    $check->close();

    $stmt = $conn->prepare("INSERT INTO registrations (student_id, event_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $student_id, $event_id);
    
    if ($stmt->execute()) {
        log_audit($conn, $student_id, 'EVENT_REGISTRATION', "Registered for event ID: $event_id");
        header("Location: Events.php?success=Successfully registered for the event!");
    } else {
        header("Location: Events.php?error=Registration failed.");
    }
    $stmt->close();
    exit();
}
?>

<?php
require_once 'db.php';
require_once 'auth_check.php';
checkAdminRole();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id    = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;
    $title       = trim($_POST['title']);
    $category    = trim($_POST['category']);
    $event_date  = $_POST['event_date'];
    $location    = trim($_POST['location']);
    $description = trim($_POST['description']);
    $poster_name = null;

    if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        $max_size      = 2 * 1024 * 1024;

        $file_tmp  = $_FILES['poster']['tmp_name'];
        $file_type = mime_content_type($file_tmp);
        $file_size = $_FILES['poster']['size'];
        $ext       = pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);

        if (!in_array($file_type, $allowed_types)) {
            header("Location: Admin.php?error=Only JPG, PNG, and WebP images allowed.");
            exit();
        }
        if ($file_size > $max_size) {
            header("Location: Admin.php?error=Image size exceeds 2MB limit.");
            exit();
        }

        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

        $poster_name = uniqid('poster_', true) . '.' . $ext;
        move_uploaded_file($file_tmp, $upload_dir . $poster_name);
    }

    if ($event_id > 0) {
        if ($poster_name) {
            $stmt = $conn->prepare("UPDATE events SET title=?, category=?, event_date=?, location=?, description=?, poster=? WHERE id=?");
            $stmt->bind_param("ssssssi", $title, $category, $event_date, $location, $description, $poster_name, $event_id);
        } else {
            $stmt = $conn->prepare("UPDATE events SET title=?, category=?, event_date=?, location=?, description=? WHERE id=?");
            $stmt->bind_param("sssssi", $title, $category, $event_date, $location, $description, $event_id);
        }
        $stmt->execute();
        log_audit($conn, $_SESSION['user_id'], 'UPDATE_EVENT', "Updated event ID: $event_id");
    } else {
        $stmt = $conn->prepare("INSERT INTO events (title, category, event_date, location, description, poster) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $title, $category, $event_date, $location, $description, $poster_name);
        $stmt->execute();
        log_audit($conn, $_SESSION['user_id'], 'ADD_EVENT', "Created event: $title");
    }
    $stmt->close();
    header("Location: Admin.php?success=Event saved successfully");
    exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    log_audit($conn, $_SESSION['user_id'], 'DELETE_EVENT', "Deleted event ID: $id");
    $stmt->close();
    header("Location: Admin.php?success=Event deleted successfully");
    exit();
}
?>
<?php
header('Content-Type: application/json');
require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $search = isset($_GET['search']) ? '%' . trim($_GET['search']) . '%' : '%';
        $stmt = $conn->prepare("SELECT id, title, category, event_date, location, description, poster FROM events WHERE title LIKE ? OR category LIKE ? ORDER BY event_date ASC");
        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        echo json_encode(['status' => 'success', 'data' => $events]);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || empty($data['title']) || empty($data['event_date'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid or missing fields']);
            exit();
        }
        $stmt = $conn->prepare("INSERT INTO events (title, category, event_date, location, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['title'], $data['category'], $data['event_date'], $data['location'], $data['description']);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Event created', 'id' => $stmt->insert_id]);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Failed to create event']);
        }
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Missing event ID']);
            exit();
        }
        $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(['status' => 'success', 'message' => 'Event deleted']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
        break;
}
?>
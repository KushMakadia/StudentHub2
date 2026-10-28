<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connect to the database using parent config.php
require_once __DIR__ . '/config.php';


// Convert special characters into safe HTML
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}


// Redirect to another page
function redirect($url)
{
    header("Location: " . $url);
    exit;
}


// Store a message to display on the next page
function set_flash($message, $type = 'success')
{
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}


// Display the beginning of an HTML page
function page_start($title)
{

    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>' . e($title) . '</title>
        <meta charset="UTF-8">
        <style>
            body {
                font-family: Arial;
                margin: 30px;
                background: #f2f2f2;
            }

            main {
                background: white;
                padding: 20px;
                border-radius: 8px;
            }

            input, select, textarea {
                padding: 8px;
                margin: 5px 0;
                width: 100%;
                box-sizing: border-box;
            }

            button, .btn {
                padding: 10px;
                background: blue;
                color: white;
                border: none;
                text-decoration: none;
                cursor: pointer;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 10px;
                border: 1px solid gray;
                text-align: left;
            }

            .success {
                color: green;
            }

            .error {
                color: red;
            }
        </style>
    </head>
    <body>

    <h2>StudentHub</h2>
    <main>
    <h1>' . e($title) . '</h1>';

    // Display any saved message
    if (isset($_SESSION['message'])) {

        $type = $_SESSION['message_type'];

        echo '<p class="' . e($type) . '">'
            . e($_SESSION['message']) . '</p>';

        // Remove the message after displaying it
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
}


// Display the end of the HTML page
function page_end()
{

    echo '</main>
    <p>StudentHub - PHP and MySQL Project</p>
    </body>
    </html>';
}


// Check whether the user is logged in
function require_login()
{

    if (!isset($_SESSION['student_id'])) {

        set_flash('Please log in first.', 'error');

        redirect('../Practical_10_Secure_Login/login.php');
    }

    // Allow the session to remain inactive for 30 minutes
    if (
        isset($_SESSION['last_activity']) &&
        time() - $_SESSION['last_activity'] > 1800
    ) {

        // Clear session data
        $_SESSION = [];

        // Destroy the session
        session_destroy();

        redirect('../Practical_10_Secure_Login/login.php');
    }

    // Update the last activity time
    $_SESSION['last_activity'] = time();
}


// Allow only admin users to access a page
function require_admin()
{

    require_login();

    if ($_SESSION['role'] != 'admin') {

        die('Access denied! Admin only.');
    }
}


// Save an important action in the audit log
function log_action($conn, $studentId, $action, $details = '')
{

    $sql = "INSERT INTO audit_logs
            (student_id, action, details, ip_address)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $ip = $_SERVER['REMOTE_ADDR'] ?? '';

    $stmt->bind_param(
        "isss",
        $studentId,
        $action,
        $details,
        $ip
    );

    $stmt->execute();

    $stmt->close();
}

?>
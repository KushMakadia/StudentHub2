<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'auth_check.php';
require_once 'db.php';

// Ensure only admins can access this page
checkAdminRole();

$user_name = $_SESSION['name'] ?? 'Admin';

// 1. Dynamically count Total Students
$student_count_query = $conn->query("SELECT COUNT(*) AS count FROM students WHERE role = 'student'");
$student_count = $student_count_query ? $student_count_query->fetch_assoc()['count'] : 0;

// 2. Dynamically count Total Events
$event_count_query = $conn->query("SELECT COUNT(*) AS count FROM events");
$event_count = $event_count_query ? $event_count_query->fetch_assoc()['count'] : 0;

// 3. Dynamically count Total Event Registrations
$reg_count_query = $conn->query("SELECT COUNT(*) AS count FROM registrations");
$reg_count = $reg_count_query ? $reg_count_query->fetch_assoc()['count'] : 0;

// 4. Dynamically count Total System Actions (Audit Logs)
$log_count_query = $conn->query("SELECT COUNT(*) AS count FROM audit_logs");
$log_count = $log_count_query ? $log_count_query->fetch_assoc()['count'] : 0;

// 5. Fetch the 5 most recent activities from the audit_logs table, joined with the students table for names
$recent_activity = $conn->query(
    "SELECT a.created_at, a.action, a.details, s.name 
     FROM audit_logs a 
     LEFT JOIN students s ON a.student_id = s.student_id 
     ORDER BY a.created_at DESC 
     LIMIT 5"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentHub - Admin</title>

    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <header class="site-header">
        <div class="header-container">
            <div class="logo-section">
                <img src="logo.png" alt="StudentHub Logo" class="logo">
                <h2 class="site-title">StudentHub</h2>
            
        <button class="menu-toggle" aria-label="Open navigation menu" aria-expanded="false">
            ☰
        </button>

            </div>
            <nav class="navbar">
                <a href="index.html">Home</a>
                <a href="Profile.php">Profile</a>
                <a href="Dashboard.php">Dashboard</a>
                <a href="FAQ.html">FAQs</a>
                <a href="Events.php">Events</a>
                <a href="Contact_Us.html">Contact Us</a>
                <a href="About_Us.html">About Us</a>
                <a href="Admin.php" class="active">Admin</a>
                <a href="logout.php" style="color: #dc3545; font-weight: bold;">Logout</a>
            </nav>

       <button id="theme-toggle" class="theme-btn" aria-label="Toggle light and dark theme">
            🌙
        </button>
        </div>
    </header>

    <main class="main-content">

        <section class="admin-header">
            <h1>Admin Dashboard (<?= htmlspecialchars($user_name); ?>)</h1>
            <p>Manage students, events, feedback and StudentHub activities.</p>
        </section>

        <!-- LIVE DYNAMIC STATS -->
        <section class="admin-stats">
            <div class="admin-stat-card">
                <h2><?= $student_count; ?></h2>
                <p>Total Students</p>
            </div>

            <div class="admin-stat-card">
                <h2><?= $event_count; ?></h2>
                <p>Total Events</p>
            </div>

            <div class="admin-stat-card">
                <h2><?= $reg_count; ?></h2>
                <p>Event Registrations</p>
            </div>

            <div class="admin-stat-card">
                <h2><?= $log_count; ?></h2>
                <p>System Actions</p>
            </div>
        </section>

        <section class="admin-content">
            <div class="admin-card">
                <h2>Student Management</h2>
                <p>View registered students and manage their StudentHub accounts.</p>
                <a href="#" class="btn">Manage Students</a>
            </div>

            <div class="admin-card">
                <h2>Event Management</h2>
                <p>Add, update or remove campus events displayed on StudentHub.</p>
                <a href="Events.php" class="btn">Manage Events</a>
            </div>

            <div class="admin-card">
                <h2>Feedback</h2>
                <p>Review feedback submitted by students and respond to their queries.</p>
                <a href="#" class="btn">View Feedback</a>
            </div>

            <div class="admin-card">
                <h2>Announcements</h2>
                <p>Create announcements and share important information with students.</p>
                <a href="#" class="btn">Create Announcement</a>
            </div>
        </section>

        <!-- LIVE RECENT ACTIVITY LOGS -->
        <section class="recent-activity">
            <h2>Live Recent Activity</h2>
            <table>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Activity</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($recent_activity && $recent_activity->num_rows > 0): ?>
                        <?php while ($log = $recent_activity->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($log['name'] ?? 'System / Guest') ?></td>
                                <td><?= htmlspecialchars($log['details']) ?></td>
                                <td><?= htmlspecialchars(date('d M Y, h:i A', strtotime($log['created_at']))) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">No recent activity found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

    </main>

    <footer class="site-footer">
        <p>&copy; 2026 StudentHub. All Rights Reserved.</p>
    </footer>

</body>
</html>
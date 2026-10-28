<?php
require_once 'auth_check.php';
require_once 'db.php';

$user_id = $_SESSION['user_id'] ?? 'Unknown';
$user_name = $_SESSION['name'] ?? 'Student';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentHub - Dashboard</title>

    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>

<header class="site-header">
        <div class="header-container">
            <div class="logo-section">
                <img src="logo.png" alt="StudentHub Logo" class="logo">
                <h2 class="site-title">StudentHub</h2>
            
        <button class="menu-toggle"
                aria-label="Open navigation menu"
                aria-expanded="false">
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
                <a href="logout.php" style="color: #dc3545; font-weight: bold; border: 2px solid #dc3545;">Logout</a>
            </nav>

       <button id="theme-toggle"
                class="theme-btn"
                aria-label="Toggle light and dark theme">
            🌙
        </button>
        </div>
    </header>

    <main class="main-content">

        <section class="dashboard-header">
            <h1>Welcome back, <?php echo htmlspecialchars($user_name); ?>!</h1>
            <p>Here's a quick overview of your student activities.</p>
        </section>

        <section class="dashboard-grid">

            <div class="dashboard-card">
                <h2>Profile</h2>
                <p>View and update your personal details.</p>
                <a href="Profile.html" class="btn">View</a>
            </div>

            <div class="dashboard-card">
                <h2>Events</h2>
                <p>Check upcoming campus events and activities.</p>
                <a href="Events.php" class="btn">Explore</a>
            </div>

            <div class="dashboard-card">
                <h2>Attendance</h2>
                <p>Current Attendance</p>
                <h3>91%</h3>
            </div>

            <div class="dashboard-card">
                <h2>Assignments</h2>
                <p>Pending Assignments</p>
                <h3>3</h3>
            </div>

            <div class="dashboard-card">
                <h2>Notifications</h2>
                <ul>
                    <li>Web Development Workshop</li>
                    <li>Assignment Submission Due</li>
                    <li>Sports Meet Registration Open</li>
                </ul>
            </div>

            <div class="dashboard-card">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="FAQ.html">FAQs</a></li>
                    <li><a href="Contact_Us.html">Contact Support</a></li>
                    <li><a href="About_Us.html">About StudentHub</a></li>
                </ul>
            </div>

        </section>

    </main>

    <footer class="site-footer">
        <p>&copy; 2026 StudentHub. All Rights Reserved.</p>
    </footer>
    
</body>
</html>
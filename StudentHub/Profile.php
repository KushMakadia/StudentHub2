<?php
require_once 'auth_check.php';
require_once 'db.php';

// 1. Fetch all your details from the database using your session ID
$stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentHub - Profile</title>

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
                <a href="Profile.php" class="active">Profile</a>
                <a href="Dashboard.php">Dashboard</a>
                <a href="FAQ.html">FAQs</a>
                <a href="Events.php">Events</a>
                <a href="Contact_Us.html">Contact Us</a>
                <a href="About_Us.html">About Us</a>
                <a href="logout.php" style="color: #dc3545; font-weight: bold; border: 2px solid #dc3545;">Logout</a>
            </nav>

       <button id="theme-toggle" class="theme-btn" aria-label="Toggle light and dark theme">
            🌙
        </button>
        </div>
    </header>

    <main class="main-content">

        <section class="profile-card">

            <div class="profile-heading">
                <!-- Dynamically grab the first letter of the name for the icon -->
                <div class="profile-icon"><?= htmlspecialchars(strtoupper(substr($student['name'], 0, 1))) ?></div>

                <div>
                    <h1>Student Profile</h1>
                    <p>View and manage your StudentHub information.</p>
                </div>
            </div>

            <hr>

            <div class="profile-details">
                <!-- Dynamically echoing database fields -->
                <div class="profile-item">
                    <span>Full Name</span>
                    <strong><?= htmlspecialchars($student['name']) ?></strong>
                </div>

                <div class="profile-item">
                    <span>Email</span>
                    <strong><?= htmlspecialchars($student['email']) ?></strong>
                </div>

                <div class="profile-item">
                    <span>Mobile Number</span>
                    <strong><?= htmlspecialchars($student['mobile']) ?></strong>
                </div>

                <div class="profile-item">
                    <span>Course</span>
                    <strong><?= htmlspecialchars($student['course']) ?></strong>
                </div>

                <div class="profile-item">
                    <span>Year of Study</span>
                    <strong>Year <?= htmlspecialchars($student['year']) ?></strong>
                </div>

                <div class="profile-item">
                    <span>Gender</span>
                    <strong><?= htmlspecialchars($student['gender']) ?></strong>
                </div>

                <div class="profile-item">
                    <span>Account Role</span>
                    <strong style="text-transform: capitalize;"><?= htmlspecialchars($student['role']) ?></strong>
                </div>
            </div>

            <div class="profile-actions">
                <a href="#" class="btn">Edit Profile</a>
                <a href="Dashboard.php" class="profile-secondary-btn">
                    Back to Dashboard
                </a>
            </div>

        </section>

    </main>

    <footer class="site-footer">
        <p>&copy; 2026 StudentHub. All Rights Reserved.</p>
    </footer>

</body>
</html>
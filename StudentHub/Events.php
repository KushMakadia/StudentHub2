<?php
require_once 'db.php';
session_start();

$result = $conn->query("SELECT id, title, category, event_date, location, description, poster FROM events ORDER BY event_date ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentHub - Events</title>

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
            <a href="house.html">Home</a>
            <a href="Register.html">Register</a>
            <a href="Login.html">Login</a>
            <a href="Profile.html">Profile</a>
            <a href="Dashboard.php">Dashboard</a>
            <a href="FAQ.html">FAQs</a>
            <a href="Events.php">Events</a>
            <a href="Contact_Us.html">Contact Us</a>
            <a href="About_Us.html">About Us</a>
            <a href="Admin.php">Admin</a>
        </nav>

        <button id="theme-toggle"
            class="theme-btn"
            aria-label="Toggle light and dark theme">
        🌙
         </button>
        </div>
    </header>

    <main class="main-content">

        <section class="events-header">

            <h1>Campus Events</h1>

            <p>
                Stay updated with the latest workshops, seminars,
                competitions and cultural activities happening on campus.
            </p>

        </section>

        <section class="events-container">

            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($event = $result->fetch_assoc()): ?>
                    <div class="event-card">
                        <?php if (!empty($event['poster'])): ?>
                            <img src="uploads/<?php echo htmlspecialchars($event['poster']); ?>" alt="Event Poster" style="width:100%; max-height:160px; object-fit:cover; margin-bottom:10px; border-radius:4px;">
                        <?php endif; ?>
                        <h2><?php echo htmlspecialchars($event['title']); ?></h2>
                        <?php if (!empty($event['category'])): ?>
                            <p><strong>Category:</strong> <?php echo htmlspecialchars($event['category']); ?></p>
                        <?php endif; ?>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>
                        <p><strong>Venue:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
                        
                        <form action="register_event.php" method="POST" style="margin-top:10px;">
                            <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                            <button type="submit" class="btn">Register</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No events found in the database.</p>
            <?php endif; ?>

        </section>

    </main>

    <footer class="site-footer">
        <p>&copy; 2026 StudentHub. All Rights Reserved.</p>
    </footer>

</body>
</html>
<?php
$conn->close();
?>

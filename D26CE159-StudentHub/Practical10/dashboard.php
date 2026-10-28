<?php require '../config.php';
if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
} ?>
<h2>Welcome <?= h($_SESSION['name']) ?></h2>
<p>Role: <?= h($_SESSION['role']) ?></p><a
    href="logout.php">Logout</a><?php if ($_SESSION['role'] === 'admin')
        echo ' | <a href="../Practical14/index.php">Admin dashboard</a>'; ?>
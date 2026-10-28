<?php
session_start();

session_destroy();

header("Location: index.php");
exit;
?>

<!DOCTYPE html>
<html>
<head>
    <title>aade2b82</title>
</head>
<body>

<h1>Logged Out</h1>

<p>You have been logged out.</p>

<p>
    <a href="index.php">Login Again</a>
</p>

</body>
</html>
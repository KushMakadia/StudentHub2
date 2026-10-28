<?php
session_start();

if (isset($_POST['who']) && isset($_POST['pass'])) {
    $email = $_POST['who'];
    $password = $_POST['pass'];

    if (strpos($email, '@') === false) {
        $_SESSION['error'] = "Email must have an @";
        header("Location: login.php");
        exit();
    }

    if ($password != "php123") {
        $_SESSION['error'] = "Incorrect password";
        header("Location: login.php");
        exit();
    }

    $_SESSION['user'] = $email;

    header("Location: game.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login aade2b82</title>
</head>

<body>

<h1>Please Log In</h1>

<?php
if (isset($_SESSION['error'])) {
    echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
}
?>

<form method="post">
    <p>
        <label for="who">Email</label>
        <input type="text" name="who" id="who">
    </p>

    <p>
        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass">
    </p>

    <input type="submit" value="Log In">
</form>

<p>
    <a href="RockPaper.php">Cancel</a>
</p>

</body>
</html>
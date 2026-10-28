<?php
session_start();

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';

if (isset($_POST['who']) && isset($_POST['pass'])) {

    $who = trim($_POST['who']);
    $pass = $_POST['pass'];

    if ($who == '' || $pass == '') {
        $_SESSION['error'] = 'User name and password are required';
        header('Location: login.php');
        exit;
    }

    $check = hash('md5', $salt . $pass);

    if ($check == $stored_hash) {

        $_SESSION['name'] = $who;

        header('Location: game.php');
        exit;

    } else {

        $_SESSION['error'] = 'Incorrect password';
        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>aade2b82</title>
</head>
<body>

<h1>Welcome to Rock Paper Scissors</h1>

<?php
if (isset($_SESSION['error'])) {
    echo '<p style="color:red;">';
    echo htmlentities($_SESSION['error']);
    echo '</p>';

    unset($_SESSION['error']);
}
?>

<form method="POST">

<p>
User Name:
<input type="text" name="who">
</p>

<p>
Password:
<input type="password" name="pass">
</p>

<p>
<input type="submit" value="Log In">
</p>

</form>

</body>
</html>
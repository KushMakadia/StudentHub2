<?php
session_start();

$choices = array(
    0 => "Rock",
    1 => "Paper",
    2 => "Scissors"
);

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_POST['play'])) {
    $user = $_POST['choice'];
    $computer = rand(0, 2);

    echo "<p>Your Play: " . $choices[$user] . "</p>";
    echo "<p>Computer Play: " . $choices[$computer] . "</p>";

    if ($user == $computer) {
        echo "<p>Result: Tie</p>";
    } elseif (
        ($user == 0 && $computer == 2) ||
        ($user == 1 && $computer == 0) ||
        ($user == 2 && $computer == 1)
    ) {
        echo "<p>Result: You Win</p>";
    } else {
        echo "<p>Result: You Lose</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rock Paper Scissors aade2b82</title>
</head>

<body>

<h1>Rock Paper Scissors</h1>

<p>
    <a href="login.php">Please Log In</a>
</p>

<form method="post">
    <label>Choose your play:</label>

    <select name="choice">
        <option value="0">Rock</option>
        <option value="1">Paper</option>
        <option value="2">Scissors</option>
    </select>

    <input type="submit" name="play" value="Play">
</form>

</body>
</html>
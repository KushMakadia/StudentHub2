<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$names = array("Rock", "Paper", "Scissors");

function check($computer, $human) {
    if ($computer == $human) {
        return "Tie";
    }

    if (($human == 0 && $computer == 2) ||
        ($human == 1 && $computer == 0) ||
        ($human == 2 && $computer == 1)) {
        return "You Win";
    }

    return "You Lose";
}

$human = null;
$computer = null;
$result = null;

if (isset($_POST['human'])) {
    $human = $_POST['human'];
    $computer = rand(0, 2);
    $result = check($computer, $human);
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
    Welcome <?php echo htmlspecialchars($_SESSION['user']); ?>
</p>

<?php
if ($result !== null) {
    echo "Your Play=" . $names[$human] . "\n";
    echo "Computer Play=" . $names[$computer] . "\n";
    echo "Result=" . $result . "\n";
}
?>


<form method="post">
    <select name="human">
        <option value="0">Rock</option>
        <option value="1">Paper</option>
        <option value="2">Scissors</option>
    </select>

    <input type="submit" value="Play">
</form>

<p>
    <a href="RockPaper.php">Log Out</a>
</p>

</body>
</html>
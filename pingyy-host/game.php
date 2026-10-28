<?php
session_start();

if (!isset($_SESSION['name'])) {
    die("Name parameter missing");
}

$names = array(
    "Rock",
    "Paper",
    "Scissors"
);

function check($computer, $human)
{
    if ($computer == $human) {
        return "Tie";
    }

    if (
        ($human == 0 && $computer == 2) ||
        ($human == 1 && $computer == 0) ||
        ($human == 2 && $computer == 1)
    ) {
        return "You Win";
    }

    return "You Lose";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>aade2b82</title>
</head>
<body>

<h1>Rock Paper Scissors</h1>

<p>
    Welcome:
    <?php echo htmlentities($_SESSION['name']); ?>
</p>

<form method="post">

<select name="human">
    <option value="-1">Select</option>
    <option value="0">Rock</option>
    <option value="1">Paper</option>
    <option value="2">Scissors</option>
    <option value="3">Test</option>
</select>

<input type="submit" name="play" value="Play">

</form>

<?php

if (isset($_POST['play'])) {

    $human = $_POST['human'];

    if ($human == 3) {

        for ($c = 0; $c < 3; $c++) {

            for ($h = 0; $h < 3; $h++) {

                $result = check($c, $h);

                echo "Human=$names[$h] Computer=$names[$c] Result=$result<br>";
            }
        }

    } elseif ($human >= 0 && $human <= 2) {

        $computer = rand(0, 2);

        $result = check($computer, $human);

        echo "<p>";
        echo "Your Play=" . $names[$human];
        echo " Computer Play=" . $names[$computer];
        echo " Result=" . $result;
        echo "</p>";
    }
}

?>

<form method="post">
    <input type="submit" name="logout" value="Logout">
</form>

<?php

if (isset($_POST['logout'])) {

    session_destroy();

    header("Location: index.php");
    exit;
}

?>

</body>
</html>
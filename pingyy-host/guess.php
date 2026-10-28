
<!DOCTYPE html>
<html>
<head>
    <title>Kush Makadia aade2b82 Guessing Game</title>
</head>
<body>
    <h1>Guessing Game</h1>

    <?php
    if (!isset($_GET['guess'])) {
        echo "Missing guess parameter";
    } else if (strlen($_GET['guess']) < 1) {
        echo "Your guess is too short";
    } else if (!is_numeric($_GET['guess'])) {
        echo "Your guess is not a number";
    } else if ($_GET['guess'] < 75) {
        echo "Your guess is too low";
    } else if ($_GET['guess'] > 75) {
        echo "Your guess is too high";
    } else {
        echo "Congratulations - You are right";
    }
    ?>

    <form method="get">
        <label for="guess">Enter your guess:</label>
        <input type="text" name="guess" id="guess">
        <input type="submit" value="Check Guess">
    </form>
</body>
</html>
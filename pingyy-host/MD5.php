<!DOCTYPE html>
<html>
<head>
    <title>MD5 Cracker</title>
</head>
<body>

<h1>MD5 Cracker</h1>

<form method="GET">
    <input type="text" name="md5" size="40">
    <input type="submit" value="Crack MD5">
</form>

<?php

if (isset($_GET['md5'])) {

    $md5 = $_GET['md5'];

    $start = microtime(true);

    $found = false;
    $pin = "Not found";

    echo "<p>Debug Output:</p>";

    for ($i = 0; $i < 10000; $i++) {

        $guess = sprintf("%04d", $i);
        $check = hash('md5', $guess);

        // Display first 15 attempts
        if ($i < 15) {
            echo $check . " " . $guess . "<br>";
        }

        if ($check == $md5) {
            $pin = $guess;
            $found = true;
            break;
        }
    }

    $elapsed = microtime(true) - $start;

    echo "<p>PIN: " . $pin . "</p>";
    echo "<p>Elapsed time: " . $elapsed . "</p>";
}

?>

</body>
</html>
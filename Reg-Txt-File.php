<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $csv_file = 'users.csv';

    $form_data = [$username, $email, $password];

    if (($handle = fopen($csv_file, 'a')) !== FALSE) {
        
        fputcsv($handle, $form_data);
        
        fclose($handle);

        echo "<h3>Registration successful! Data saved to CSV.</h3>";
        echo "<a href='X(Home).html'>Go Back</a>";
    }
    else
    {
        echo "Error: Unable to open or write to the file.";
    }
}
?>

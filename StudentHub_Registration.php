<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $usernm = $_POST['usernm'] ?? '';
    echo $fullnm." ".$email." ".$usernm;
}



?>

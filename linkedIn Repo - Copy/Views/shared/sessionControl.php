<?php
session_start();
if(isset($_SESSION['userId']))
{
    $userId = $_SESSION['userId'];
}
else 
{
    header('location: ../Auth/login.php ');
    exit();
}
?>
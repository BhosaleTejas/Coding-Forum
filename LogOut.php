<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true)
{
    header("location:index.php");
    exit;
}
else
{
    session_unset();
session_destroy();

$showError=  "Log Out Successfuly!";
header("location:index.php?showError= $showError");


    exit;
}

?>
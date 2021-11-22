<?php
//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );

include '_dbConnect.php';

$id = $_GET['id'];

// Start the session
session_start();

$sql = "DELETE FROM products WHERE pid='$id'";
$result = mysqli_query($conn, $sql);

$_SESSION["delete"] = false;
$_SESSION["deleteAlert"] = false;

if($result)
{
  $_SESSION["delete"] = true;  
  header("Location:adminProduct.php");
}
else
{
    $_SESSION["delete"] = false;
    $_SESSION["deleteAlert"] = true;
    header("Location:adminProduct.php");
}

?>
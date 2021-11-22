<?php
//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );

include '_dbConnect.php';

// Start the session
session_start();

if(isset($_GET['uid']))
{
    $uid = $_GET['uid'];
    $sql = "delete from orderhistory where uid='$uid'";
    $result = mysqli_query($conn,$sql);

    $sqll = "delete from checkoutProducts where uid='$uid'";
    $resultt = mysqli_query($conn,$sqll);

$_SESSION['clearOrder'] = false;

if($result && $resultt)
{
    $_SESSION['clearOrder'] = true;
    header("Location:order.php?uid=$uid");
}
}
?>
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

if(isset($_GET['pid']))
{
$pid = $_GET['pid'];
$uid = $_SESSION['uid'];

$sql = "delete from wishlist where pid='$pid' and uid='$uid'";
$result = mysqli_query($conn,$sql);

$_SESSION['wishlistRemoved'] = false;

if($result)
{
    $_SESSION['wishlistRemoved'] = true;
    header("Location:ViewWishlist.php?uid=$uid");
}
}

if(isset($_GET['uid']))
{
    $uid = $_GET['uid'];
    $sql = "delete from wishlist where uid='$uid'";
    $result = mysqli_query($conn,$sql);

$_SESSION['wishlistRemovedAll'] = false;

if($result)
{
    $_SESSION['wishlistRemovedAll'] = true;
    header("Location:ViewWishlist.php?uid=$uid");
}
}
?>
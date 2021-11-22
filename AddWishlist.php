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


if(!$_SESSION['uname'])
{
        $_SESSION['AddWishlistAlert'] = true;
        header("Location:index.php");
}

else 
{
$uname = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$pid = $_GET["pid"];

$sql = "select * from wishlist where uid='$uid' and pid='$pid'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$_SESSION['wishlistAdded'] = false;
$_SESSION['AlreadyWishlist'] = false;

if(!$row)
{
$sql = "INSERT INTO `wishlist` ( `uid`, `uname`, `pid`, `date`) VALUES ('$uid', '$uname', '$pid', current_timestamp())";
$resultt = mysqli_query($conn,$sql);
$_SESSION['wishlistAdded'] = true;
header("Location:ViewWishlist.php?uid=$uid");
}
else
{
    $_SESSION['AlreadyWishlist'] = true;
    header("Location:ViewWishlist.php?uid=$uid");
}
}

?>
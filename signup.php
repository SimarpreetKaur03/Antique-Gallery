<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
include '_dbConnect.php';

$name = $_POST["name"];
$name = strtolower($name);
$name = ucwords($name);
$email = $_POST["email"];
$password = $_POST["password"];
$sql = "Select * from users where email='$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$_SESSION["signup"] = false;
$_SESSION["signupAlert"] = false;

if(!$row){
$sql = "INSERT INTO `users` ( `uname`, `email`, `password`, `date`) VALUES ('$name', '$email', '$password', current_timestamp())";
$result = mysqli_query($conn, $sql);

$sqll = "select * from users where uname='$name' and email='$email'";
$resultt = mysqli_query($conn, $sqll);
$roww = mysqli_fetch_assoc($resultt);

if ($result){
$_SESSION["uname"] = $name;
$_SESSION["uid"] = $roww['uid'];
$_SESSION["signup"] = true;
$_SESSION["email"] = $email;
}
else{
  $_SESSION["signup"] = false;
  $_SESSION["signupAlert"] = true;
  }
}
else{
$_SESSION["signup"] = false;
$_SESSION["signupAlert"] = true;
}

header("Location:index.php");
}
?>
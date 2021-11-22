<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include '_dbConnect.php';

    $email = $_POST["email"];
    $password = $_POST["password"];

    if($email == "admin@gmail.com" && $password == "admin")
    {
        header("Location:admin.php");
    }

    else
    {

    $sql = "Select * from users where email='$email' AND password='$password'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
	$name = $row['uname'];
    $id = $row['uid'];
    $email = $row['email'];

    $_SESSION["login"] = false;
    $_SESSION["loginAlert"] = false;

    if ($row){
   $_SESSION["uname"] = $name;
   $_SESSION["uid"] = $id;
   $_SESSION["login"] = true;
   $_SESSION["email"] = $email;

    } 
    else{
    $_SESSION["login"] = false;
    $_SESSION["loginAlert"] = true;
    }

    header("Location:index.php");
    }
}
?>
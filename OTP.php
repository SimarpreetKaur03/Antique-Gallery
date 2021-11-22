<?php

session_start();

//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbConnect.php';

    $_SESSION["otpconfrm"] = false;

    if($_SESSION["otp"] == $_POST["otp"])
    {
        $_SESSION["otpconfrm"] = true;
        header("Location:reset.php");
    }
    else
    {
      echo '<div class="alert text-center alert-danger alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
      <strong>Error!</strong> Incorrect OTP.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

}

if( $_SESSION["mailsent"])
{
  $_SESSION["mailsent"] = false;
  echo '<div class="alert text-center alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:10001;">
  Mail sent successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?> 

<!doctype html>
<html lang="en">

<head>
    <!-- Tab Icon -->
    <link rel="icon" href="assests/images/logo.png" type="image/icon type">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <link rel="stylesheet" href="assests/css/style.css">
    <link rel="stylesheet" href="assests/css/Product.css">

    <title>OTP Verification</title>
</head>

<style>
  main form p a {
    color:white;
  }
  main form p:hover a {
    color:#333;
  }
</style>

<body>

<main>
<div class="otp-container active text-center" id="otp">

<a href="index.php" id="otp-close"><i class="fas fa-times"></i></a>

<form action="OTP.php" method="POST">
  <h3 class="pt-5">Galerie d'antiquités®</h3>
  <hr>
  <input type="number" class="box my-3" name="otp" placeholder="Enter OTP">
  <div class="d-flex pb-5">
  <input type="submit" value="Verify" class="btn mx-2">
  <?php  $email = $_SESSION['email'];
  echo '<p class="mx-2 btn"><a href="resend.php?email='.$email.'"><span>Resend OTP</span></a></p>'; ?>
  </div>
</form>
</div>

</main>

    <script src="assests/js/main.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

</body>

</html>    
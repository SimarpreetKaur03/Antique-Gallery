<?php

session_start();

//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );

if($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbConnect.php';

    $email = $_SESSION['email'];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    if($password == $cpassword) {
    $sql = "update users set password='$password' where email='$email'";
    $result = mysqli_query($conn, $sql);

    $sql = "Select * from users where email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
	$name = $row['uname'];
    $id = $row['uid'];

    $_SESSION["reset"] = false;
    $_SESSION["resetAlert"] = false;

    if ($row){
   $_SESSION["uname"] = $name;
   $_SESSION['uid'] = $id;
   $_SESSION["reset"] = true;
   $_SESSION["email"] = $row['email'];
   header("Location:index.php");
    }

   else{
    echo '<div class="alert text-center alert-danger alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
          <strong>Error!</strong> Incorrect Password.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
} 
    else{
          echo '<div class="alert text-center alert-danger alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
          <strong>Error!</strong> Incorrect Password.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

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

    <title>Reset Password</title>
</head>

<style>
  @media (max-width:600px) {
  form .show {
     font-size: .6rem;
  }
}
</style>

<body>

<main>
<div class="reset-password-container active text-center" id="reset">

<a href="index.php" id="reset-close"><i class="fas fa-times"></i></a>

<form action="reset.php" method="POST">
            <h3>Galerie d'antiquités®</h3>
            <hr>
            <input type="password" id="pwd" name="password" class="box form-control" placeholder="Enter New Password"required>
            <input type="password" id="pswd" name="cpassword" class="box form-control" placeholder="Confirm Password"required>
            <div class="d-flex flex-row show my-2">
            <input type="checkbox" onclick="showPassword()"> <div>&nbspShow Password</div>
            </div>    
            <input type="submit" value="Change Password" class="btn">
</form>
</div>

</main>

    <script src="assests/js/main.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

<script>
  function showPassword() {
  var x = document.getElementById("pwd");
  var y = document.getElementById("pswd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}
</script>

</body>

</html>    
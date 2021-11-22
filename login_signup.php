<?php
//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );

// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<style>
  @media (max-width:600px) {
  form .show {
     font-size: .6rem;
  }
}
</style>

<body>
   
  <!-- login form container ***************************************************************************************************** -->

  <div class="login-form-container text-center" id="login">

<i class="fas fa-times" id="form-close"></i>

<form action="login.php" method="POST">
    <h3>Galerie d'antiquités®</h3>
    <hr>
    <input type="email" name="email" class="box form-control" placeholder="Enter Your Email" required>
    <input type="password" id="pwd" name = "password" class="box form-control" placeholder="Enter Your Password" required>
    <div class="d-flex flex-row show my-2">
    <input type="checkbox" onclick="showPassword()"> <div>&nbspShow Password</div>
    </div>
    <div class="d-flex flex-row">
    <input type="submit" value="Log In" class="btn mx-2">
    <input type="reset" value="Reset" class="btn mx-2">
    </div>
    <p class="my-2"><a href="#forget"onclick="forget()"><b>forgot password?</b></a></p>
    <p>Don't have an account? <a href="#signup" onclick="signup()"><b>Sign Up</b></a></p>
</form>

</div>

  <!-- signup form container  ************************************************************************************************-->

<div class="signup-form-container text-center" id="signup">

<i class="fas fa-times" id="signup-close"></i>

<form action="signup.php" method="POST">
    <h3>Galerie d'antiquités®</h3>
    <hr>
    <input type="name" name="name" class="box form-control" placeholder="Enter Your Name" required>
    <input type="email" name="email" class="box form-control" placeholder="Enter Your Email" required>
    <input type="password" name="password" id="pswd" class="box form-control" placeholder="Enter Your Password" required>
    <div class="d-flex flex-row show my-2">
    <input type="checkbox" onclick="showPassword()"> <div>&nbspShow Password</div>
    </div>
    <div class="d-flex flex-row">
    <input type="submit" value="Sign Up" class="btn mx-2">
    <input type="reset" value="Reset" class="btn mx-2">
    </div>
    <p class="my-3">Already have an account? <a href="#login" onclick="login()"><b>Log In</b></a></p>
</form>

</div>


  <!-- forgot password container  ****************************************************************************************************-->

  <div class="forget-password-container text-center" id="forget">

<i class="fas fa-times" id="forget-close"></i>

<form action="forgot.php" method="POST">
    <h3>Galerie d'antiquités®</h3>
    <hr>
    <input type="email" name="email" class="box form-control" placeholder="Enter Your Email" required>
    <input type="submit" value="Send OTP" class="btn">
</form>
</div>


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
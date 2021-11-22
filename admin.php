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


<!-- css files -->
<link rel="stylesheet" href="assests/css/style.css">
<link rel="stylesheet" href="assests/css/Product.css">

<title>Admin Panel</title>
</head>

<style>
  .box:hover i {
    transform: scale(1.1);
  }
  main {
    overflow:hidden;
    margin:250px 3rem 3rem 3rem;
  }
  @media (max-width:600px) {
    main {
      margin:200px 3rem 3rem 3rem;
    }
  }
</style>

<body>
    
     <!-- header section starts ******************************************************************************************* -->
  <header id="topheader">

    <nav class="navbar navbar-expand-lg  navbar-dark" aria-label="Tenth navbar example" 
    style="background: black;box-shadow: 0px 4px 8px rgb(0, 0, 0,0.5);">

  <div class="container-fluid">
    <button class="navbar-toggler collapsed mb-3 text-white" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <img src="assests/images/logo.png" alt="" class="image-fluid rounded-circle" style="width:8vh">
    <div class="brand py-2"><a href="#" class="text-white">&nbspGalerie d'antiquités®</a></div>
    <div class="navbar-collapse justify-content-md-center collapse" id="navbarsExample08">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="adminAdd.php">Add Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminProduct.php">View All Products</a>
        </li>
      </ul>
    </div>
    <div>
      <div class="icons text-white">
        <a href="logout.php" style="color:#c9b040">Log Out</a>            
      </div>
    </div>
  </div>
</nav>
  </header>
  <!-- header section ends -->


  <main>
     <div class="row" style="background:white">
     <div class="col-xl-3">
       <div class="text-center box mx-1 my-2" style="background:#f54e4e">
         <i class="fas fa-shopping-cart text-dark py-5" style="font-size:10rem; opacity:0.4;"></i>
       </div>
       </div>
       <div class="col-xl-3">
       <div class="text-center box mx-1 my-2" style="background:#4e70f5">
         <i class="fas fa-user text-dark py-5" style="font-size:10rem; opacity:0.4;"></i>
       </div>
       </div>
       <div class="col-xl-3">
       <div class="text-center box mx-1 my-2" style="background:#4fc96d">
         <i class="fas fa-barcode text-dark py-5" style="font-size:10rem; opacity:0.4;"></i>
       </div>
       </div>
       <div class="col-xl-3">
       <div class="text-center box mx-1 my-2" style="background:#f5c84e">
         <i class="fas fa-money-bill-alt text-dark py-5" style="font-size:10rem; opacity:0.4;"></i>
       </div>
       </div>
     </div>
  </main>


  <script src="assests/js/main.js"></script>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
    crossorigin="anonymous"></script>

</body>
</html>
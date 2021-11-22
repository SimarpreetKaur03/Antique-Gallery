<?php
//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );

// Start the session
session_start();

include '_dbConnect.php';

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


    <!-- css files -->
    <link rel="stylesheet" href="assests/css/review.css">
    <link rel="stylesheet" href="assests/css/style.css">
    <link rel="stylesheet" href="assests/css/Product.css">
    <link rel="stylesheet" href="assests/css/contact.css">

    <title>Antique Gallery</title>

</head>

<body>

    <!-- header section starts ******************************************************************************************* -->
    <header id="topheader">

        <nav class="navbar navbar-expand-lg  navbar-dark" aria-label="Tenth navbar example" id="navbar">
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
                            <a class="nav-link" aria-current="page" href="index.php#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php#services">Services</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#gallery" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Gallery
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="index.php#topcategory">Top Categories</a></li>
                                <li><a class="dropdown-item" href="index.php#featured">Featured Products</a></li>
                                <li><a class="dropdown-item" href="index.php#new">New Arrivals</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php
                include '_dbConnect.php';
                $sql = "select * from search";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                    
                    foreach ($result as $row) {
                    echo'
                <li><a class="dropdown-item text-dark" href="category.php?category='.ucwords($row["sname"]).'">'.ucwords($row["sname"]).'</a></li>'; } ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php#reviews">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#deals">Deals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div class="text-center" style="color:#c9b040">
                        <?php if($_SESSION["uname"]) { echo 'Hello, ' . $_SESSION["uname"] . ' !'; } ?>
                    </div>
                    <div class="icons text-white">
                        <i class="fas fa-search px-2" id="search-btn"></i>

                        <?php $uid = $_SESSION['uid'];
             echo '<a href="ViewWishlist.php?uid='.$uid.'"><i class="fas fa-heart px-2" id="wishlist-btn"></i></a>'; 
             
             echo '<a class="nav-link" href="cart.php?uid='.$uid.'"><i class="fas fa-shopping-cart" id="cart-btn"></i> '; if($_SESSION['uname']){echo '<span id="cart-item" class="badge" style="background:var(--gold)"></span>';} echo'</a>';
             
             ?>

                        <?php
                        if(!$_SESSION["uname"])
                        echo '<i class="fas fa-sign-in-alt px-2" id="login-btn"></i>';
                        else
                        echo '<div class="btn-group dropstart">
                        <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-sign-out-alt"> </i>
                        </a>
                      
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                          <li> <hr class="dropdown-divider"> </li>
                          <li><a class="dropdown-item" href="order.php?uid='.$uid.'">Order History</a></li>
                        </ul>
                      </div>';
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        <form action="search.php" method="POST" class="search-bar-container" onclick="search()">
            <input type="search" id="search-bar" name="search" placeholder="search by category...">
            <label for="search-bar" class="fas fa-search"></label>
        </form>

        <!-- *****************************************************************************************************************************
****************************************************************************************************************************** -->
        <?php

if($_SESSION["signup"])
{
  $_SESSION["signup"] = false;
    echo '<div class="alert text-center alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
  <strong>Account created successfully !</strong> Welcome to Galerie d`antiquités®.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(!$_SESSION["signup"] && $_SESSION["signupAlert"])
{
  $_SESSION["signupAlert"] = false;
    echo '<div class="alert text-center alert-danger alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
   <strong>Error!</strong> Email is invalid or already taken.
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';
}
if($_SESSION["login"])
{
  $_SESSION["login"] = false;
  echo '<div class="alert text-center alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
  <strong>Hello, '. $_SESSION["uname"] . '! </strong> Enjoy shopping with Galerie d`antiquités®.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(!$_SESSION["login"] && $_SESSION["loginAlert"])
{
  $_SESSION["loginAlert"] = false;
  echo '<div class="alert text-center alert-danger alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
  <strong>Error!</strong> Incorrect email address or password.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if($_SESSION["forgot"])
{
  $_SESSION["forgot"] = false;
  echo '<div class="alert text-center alert-danger alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
  <strong>Error!</strong> Incorrect email address.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if($_SESSION["reset"])
{
  $_SESSION["reset"] = false;
  echo '<div class="alert text-center alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
  <strong>Hello, '. $_SESSION["uname"] . '! </strong> Password changed successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if($_SESSION["AddWishlistAlert"])
{
  $_SESSION["AddWishlistAlert"] = false;
  echo '<div class="alert text-center alert-warning alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
  Please login to add items in your wishlist!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if($_SESSION["ViewWishlistAlert"])
{
  $_SESSION["ViewWishlistAlert"] = false;
  echo '<div class="alert text-center alert-warning alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
  Please login to view items in your wishlist!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if($_SESSION["ViewCartAlert"])
{
  $_SESSION["ViewCartAlert"] = false;
  echo '<div class="alert text-center alert-warning alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
  Please login to view items in your Cart!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if($_SESSION['review'])
{
    $_SESSION['review'] = false;
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
         <strong>Thank you for your honest review!</strong> Your entry has been submitted successfully!
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
}
if($_SESSION['reviewLogin'])
{
    $_SESSION['reviewLogin'] = false;
    echo '<div class="alert text-center alert-warning alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
     <strong>Please login first to add a review!</strong>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
}
if(!$_SESSION['review'] && $_SESSION['reviewAlert'])
{
    $_SESSION['reviewAlert'] = false;
    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
         <strong>Error!</strong> We are facing some technical issue and your entry is not submitted successfully! We regret the inconvinience caused!
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
}

?>
        <!-- *****************************************************************************************************************************
****************************************************************************************************************************** -->

        <?php include 'login_signup.php'; ?>


    <!-- DIV FOR MESSAGE IF ITEM SUCCESSFULLY ADDED TO CART -->
        <div id="cart-message"></div>

    </header>
    <!-- header section ends -->


    <main>
        <!-- home section starts  **************************************************************************************************-->

        <section id="home">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assests/images/home/Desktop - 9.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Something can be old, but it can be timeless.</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assests/images/home/Desktop - 8.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5> An antique is anything old with class. </h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assests/images/home/Desktop - 7.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>I collect antiques. Why? Because they're beautiful.</h5>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <!-- home section ends -->

        <!-- services section starts  ******************************************************************************************************-->
        <section id="services">
            <div class="py-5">
                <div class="row px-5">
                    <div class="col-xl-3 py-5 services">
                        <div class="d-flex flex-row">
                            <div class="icon px-2 py-2" style="font-size: 30px;"><i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="px-2">
                                <div class="heading"><b>Fast Delivery</b></div>
                                <div class="content">Providing our customers Fast and No-Contact delivery for the sake
                                    of their Love for
                                    Antiques!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 py-5 services">
                        <div class="d-flex flex-row">
                            <div class="icon px-2 py-2" style="font-size: 30px;"><i class="fas fa-user-clock"></i></div>
                            <div class="px-2">
                                <div class="heading"><b>24x7 Support</b></div>
                                <div class="content">Order from anywhere/anytime/anything you want. Providing you 24/7
                                    services! You can
                                    contact us anytime, just tap on the Contact section above.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 py-5 services">
                        <div class="d-flex flex-row">
                            <div class="icon px-2 py-2" style="font-size: 30px;"><i class="fas fa-money-check-alt"></i>
                            </div>
                            <div class="px-2">
                                <div class="heading"><b>Easy Payment</b></div>
                                <div class="content">Payments made easy and secure. You can add/change/use
                                    Debit/Credit/COD anytime on
                                    your clock.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 py-5 services last">
                        <div class="d-flex flex-row">
                            <div class="icon px-2 py-2" style="font-size: 30px;"><i class="fas fa-box"></i></div>
                            <div class="px-2">
                                <div class="heading"><b>5 Days Replacement</b></div>
                                <div class="content">Replacing your antiques with more antiquous antiques in less than
                                    just 5 DAYS!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- services section ends -->


        <h1 class="text-center vintage-heading" style="font-size:8rem;">Vintage begins here</h1>

        <!-- topcategory section starts *********************************************************************************************************-->
        <section id="topcategory" class="py-5">
            <h1 class="text-center mb-5" style=" text-decoration: underline 5px #c9b040">TOP CATEGORIES</h1>
            <div class="container" style="color:#c9b040">
                <div class="product-items">

                    <?php 
        
          $sql = "select * from search where top='yes'"; 
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
        
          foreach ($result as $row) {
            echo
          '<div class="product">
            <div class="product-content">
              <div class="product-img">
                <a href="category.php?category='.ucwords($row["sname"]).'"><img src="'.$row["photo"].'"
                    alt="categry image"></a>
                <div class="text-center py-3 category">'.ucwords($row["sname"]).'</div>
                
              </div>
            </div>
          </div>'; }
          ?>
                </div>
            </div>
        </section>
        <!-- topcategory section ends -->

        <!-- featured section starts ***************************************************************************************************-->
        <section id="featured" class="py-5">
            <h1 class="text-center mb-5" style="text-decoration: underline 5px #c9b040;">FEATURED PRODUCTS</h1>
            <div class="container">
                <div class="product-items">

                    <?php
        
          $sql = "SELECT * FROM `products` WHERE `nf`='featured'"; 
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
        
          foreach ($result as $row) {
                    echo
                    '<div class="product">
                        <div class="product-content">
                            <div class="product-img">
                                <a href="Product.php?pid='.$row["pid"].'" class="text-dark"><img src=" '.$row["photo"].' " alt="product image"></a>    
                            </div>
                            <div class="product-btns " style="align-items: center;">';

                                $discount = $row["pprice"] - (($row["pprice"]*$row["offer"])/100);
                                $discount = intval($discount);

                                echo '<form action="" class="form-submit">
                                
                                    <input type="hidden" class="form-control pqty" value="1">
                                    <input type="hidden" class="pid" value=" '.$row["pid"].' ">
                                    <input type="hidden" class="pname" value=" '.$row["pname"].' ">
                                    <input type="hidden" class="pprice" value=" '.$discount.' ">
                                    <input type="hidden" class="pimage" value=" '.$row["photo"].' ">
                                    <a href="cart.php?uid= '.$uid.' "><button class="btn-cart addtomycart"><span><i class="fas fa-shopping-cart"></i></span></button></a>
                                </form>


                                <button type="button" class="btn-wishlist">
                                <span><a href="AddWishlist.php?pid='.$row["pid"].'" class="text-dark"><i class="fas fa-heart"></i></a></span>
                                </button>
                                <button type="button" class="btn-wishlist">
                                    <span><a href="Product.php?pid='.$row["pid"].'" class="text-dark"><i
                                                class="fas fa-eye"></i></a></span>
                                </button>


                            </div>
                        </div>

                        <div class="product-info">
                            <div class="product-info-top">
                                <h2 class="sm-title">Rating</h2>
                                <div class="rating">';

                                for($i=0; $i<$row["rating"]; $i++) {
                                    echo '<span><i class="fas fa-star"></i></span>'; }

                                    for($i=0; $i<5-$row["rating"]; $i++) {
                                    echo '<span><i class="far fa-star"></i></span>';  }

                                echo '</div>
                            </div>
                            <a class="product-name"> '.$row["pname"].' </a>';
                            
                            if($row["offer"])
                            {
                                $discount = $row["pprice"] - (($row["pprice"]*$row["offer"])/100);
                                $discount = intval($discount);
                                echo'
                            <p class="product-price-strike"> INR '. number_format($row["pprice"]) .'/-</p>
                            <p class="product-price"> INR '. number_format($discount) .'/-</p>';

                            }
                            else
                            {
                                echo '<p class="product-price"> INR '. number_format($row["pprice"]) .'/-</p>';
                            }
                        echo
                        '</div>';
                        
                        if($row["offer"]) { echo'
                        <div class="off-info">
                            <h2 class="sm-title">25% off</h2>
                        </div>'; }
                        echo
                    '</div>';
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- featured section ends -->


        <!-- New Arrivals section starts ******************************************************************************************************-->
        <section id="new" class="py-5">
            <h1 class="text-center mb-5" style="text-decoration: underline 5px #c9b040;">NEW ARRIVALS</h1>
            <div class="container">
                <div class="product-items">

                    <?php
        
          $sql = "SELECT * FROM `products` WHERE `nf`='new'"; 
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
        
          foreach ($result as $row) {
                    echo
                    '<div class="product">
                        <div class="product-content">
                            <div class="product-img">
                                <a href="Product.php?pid='.$row["pid"].'" class="text-dark"><img src=" '.$row["photo"].' " alt="product image"></a>  
                            </div>
                            <div class="product-btns " style="align-items: center;">

                                <form action="" class="form-submit">
                                
                                    <input type="hidden" class="form-control pqty" value="1">
                                    <input type="hidden" class="pid" value=" '.$row["pid"].' ">
                                    <input type="hidden" class="pname" value=" '.$row["pname"].' ">
                                    <input type="hidden" class="pprice" value=" '.$row["pprice"].' ">
                                    <input type="hidden" class="pimage" value=" '.$row["photo"].' ">
                                    <a href="cart.php?uid= '.$uid.' "><button class="btn-cart addtomycart"><span><i class="fas fa-shopping-cart"></i></span></button></a>
                                </form>


                                <button type="button" class="btn-wishlist">
                                <span><a href="AddWishlist.php?pid='.$row["pid"].'" class="text-dark"><i class="fas fa-heart"></i></a></span>
                                </button>
                                <button type="button" class="btn-wishlist">
                                    <span><a href="Product.php?pid='.$row["pid"].'" class="text-dark"><i
                                                class="fas fa-eye"></i></a></span>
                                </button>


                            </div>
                        </div>

                        <div class="product-info">
                            <div class="product-info-top">
                                <h2 class="sm-title">Rating</h2>
                                <div class="rating">';

                                for($i=0; $i<$row["rating"]; $i++) {
                                    echo '<span><i class="fas fa-star"></i></span>'; }

                                    for($i=0; $i<5-$row["rating"]; $i++) {
                                    echo '<span><i class="far fa-star"></i></span>';  }

                                echo '</div>
                            </div>
                            <a class="product-name"> '.$row["pname"].' </a>';
                            
                            if($row["offer"])
                            {
                                $discount = $row["pprice"] - (($row["pprice"]*$row["offer"])/100);
                                $discount = intval($discount);
                                echo'
                            <p class="product-price-strike"> INR '. number_format($row["pprice"]) .'/-</p>
                            <p class="product-price"> INR '. number_format($discount) .'/-</p>';

                            }
                            else
                            {
                                echo '<p class="product-price"> INR '. number_format($row["pprice"]) .'/-</p>';
                            }
                        echo
                        '</div>';
                        
                        if($row["offer"]) { echo'
                        <div class="off-info">
                            <h2 class="sm-title">25% off</h2>
                        </div>'; }
                        echo
                    '</div>';
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- New Arrivals section ends -->

        <!-- reviews section starts ******************************************************************************************************-->
        <section id="reviews" style="background:black">
            <div class="container reviewDisplay">
                <div class="veiw-box">
                    <div id="testimonials">

                    <?php $sql = "select * from ureviews order by sno desc";
                          $result = mysqli_query($conn,$sql); ?>
                        
                        <div class="user p-5">
                            
                        <?php $row = mysqli_fetch_assoc($result); ?>

                            <p class="pt-5"> <span class="fas fa-quote-left"></span> <?= $row['review'] ?> <span class="fas fa-quote-right"></span> </p>
                            <h3 class="pb-2"><?= $row['uname'] ?></h3>
                        </div>
                        
                        <div class="user space p-5">
                            
                        <?php $row = mysqli_fetch_assoc($result); ?>

                            <p class="pt-5"> <span class="fas fa-quote-left"></span> <?= $row['review'] ?> <span class="fas fa-quote-right"></span> </p>
                            <h3 class="pb-2"><?= $row['uname'] ?></h3>
                        </div>
                        
                        <div class="user p-5">
                            
                        <?php $row = mysqli_fetch_assoc($result); ?>

                            <p class="pt-5"> <span class="fas fa-quote-left"></span> <?= $row['review'] ?> <span class="fas fa-quote-right"></span> </p>
                            <h3 class="pb-2"><?= $row['uname'] ?></h3>
                        </div>
                        
                        
                    </div>
                    
                    <div class="controls">
                        <span id="control1"></span>
                        <span id="control2" class="active_review"></span>
                        <span id="control3"></span>
                    </div>
                    
                </div>
            </div>
        




            <!-- REVIEW FORM -->


            <div class="container" style=' margin-top: 50px'>
                <div class="row justify-content-center">
                    <div class="col-lg-6 px-5 pb-4" >
                        <h2 class="text-center p-2" style="color:#c9b040">Send us your Precious Review!</h2>

                        <form action="review.php" method="POST" >
                            
                            <div class="form-group my-3">
                                <input type="text" name="name" class="form-control" <?php if(!$_SESSION["uname"]) { echo 'placeholder="Name"'; } ?> value="<?= $_SESSION['uname']?>" required>
                            </div>
                            <div class="form-group my-3">
                                <input type="email" name="email" class="form-control" <?php if(!$_SESSION["uname"]) { echo 'placeholder="Email"'; } ?> value="<?= $_SESSION['email']?>"  required>
                            </div>
                            
                            <div class="form-group my-3">
                                <textarea name="review" class="form-control" rows="4" cols="10"
                                    placeholder="Enter Your Review Here..."></textarea>
                            </div>
                            
                            <div class="form-group my-3" align="center">
                                <input type="submit" name="submit" value="Shoot" class="btn-sm btn-secondary mx-2 p-2" style="color: white;">
                                <input type="reset" name="Reset" value="Reset" class="btn-sm btn-secondary mx-2 p-2" style="color: white;">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>


        </section>
        <!-- reviews section ends -->

        <!-- deals section starts *************************************************************************************************************-->
        <section class="deal pt-5 mt-5" id="deals">

            <h1 class="heading text-center" style="text-decoration: underline 5px #c9b040;"> <span> BEST DEALS
                </span> </h1>

            <div class="box-container py-5">

                <div class="box">
                    <img src="assests/images/deals/Desktop - 3.png" alt="camera">
                    <div class="content">
                        <h3>RETRO TECH</h3>
                        <p>upto 25% off on first purchase</p>
                        <a href="category.php?category=Retro Tech"><button class="btn text-uppercase">Shop
                                now</button></a>
                    </div>
                </div>

                <div class="box">
                    <img src="assests/images/deals/Desktop - 2.png" alt="jewellery">
                    <div class="content">
                        <h3>ANTIQUE JEWELLERY</h3>
                        <p>upto 25% off on first purchase</p>
                        <a href="category.php?category=Jewellery"><button class="btn text-uppercase">Shop
                                now</button></a>
                    </div>
                </div>

            </div>
        </section>
        <!-- deals section ends -->

        <!-- footer section ********************************************************************************************************************-->
        <?php include 'footer.php'; ?>
    </main>

    <script src="assests/js/review.js"></script>
    <script src="assests/js/main.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>


    <script type="text/javascript">
      $(document).ready(function() {

        // Send product details in the server
        $(".addtomycart").click(function(e) {
          e.preventDefault();
          var $form = $(this).closest(".form-submit");
          var pid = $form.find(".pid").val();
          var pname = $form.find(".pname").val();
          var pprice = $form.find(".pprice").val();
          var pimage = $form.find(".pimage").val();

          var pqty = $form.find(".pqty").val();

          $.ajax({
            url: 'action.php',
            method: 'post',
            data: {
              pid: pid,
              pname: pname,
              pprice: pprice,
              pqty: pqty,
              pimage: pimage,
              
            },
            success: function(response) {
              $("#cart-message").html(response);
              window.scrollTo(0, 0);
              load_cart_item_number();
            }
          });
        });

        // Load total no.of items added in the cart and display in the navbar
        load_cart_item_number();

        function load_cart_item_number() {
          $.ajax({
            url: 'action.php',
            method: 'get',
            data: {
              cartItem: "cart_item"
            },
            success: function(response) {
              $("#cart-item").html(response);
            }
          });
        }
      });
    </script>
    
</body>

</html>
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

$pid = $_GET["pid"];
$sql = "SELECT * FROM `products` WHERE `pid`='$pid'";
$result = mysqli_query($conn, $sql);
$rowww = mysqli_fetch_assoc($result);

$discount = $rowww["pprice"] - (($rowww["pprice"]*$rowww["offer"])/100);
$discount = intval($discount);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product Description</title>

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

    <!-- CSS STYLE SHEETS -->
    <link rel="stylesheet" type="text/css" href="assests/css/ProPage.css">
    <link rel="stylesheet" href="assests/css/style.css">
    <link rel="stylesheet" href="assests/css/Product.css">

</head>

<style>
.header2 span.cursor {
  display: inline-block;
  background-color: #ccc;
  margin-left: 0.1rem;
  width: 3px;
  animation: blink 1s infinite;
}
.header2 span.cursor.typing {
  animation: none;
}
@keyframes blink {
  0%  { background-color: #ccc; }
  49% { background-color: #ccc; }
  50% { background-color: transparent; }
  99% { background-color: transparent; }
  100%  { background-color: #ccc; }
}
</style>

<body>

    <!-- header section -->
    <header id="topheader">

    <?php include 'header.php'; ?>
    <?php include 'login_signup.php'; ?>

    <div id="cart-message"></div>

    </header>
    <!-- header section ends -->


    <!-- ************************************************************************************************** -->
    <main>
        <!-- Image header -->
        <div class="header2 mt-5">
            <div class="header2-info text-center">
                <h1><b><span class="typed-text"></span><span class="cursor text-white">&nbsp;</span></b></h1>
                <br>
                <h2>For the love of Antiques!</h2>
                <br>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row outer-box">
            <div class="col-md-6 left-box my-5">

                <div class="product-img pro-img my-5" id="zoom-img">
                    <img src="<?php echo $rowww["photo"]; ?>" alt="product image">
                </div>

            
                <div class="pro-service">

                    <div class="row pro-service-row">
                        <div class="col">
                            <div class="icon px-2 py-2" style="font-size: 30px;"><i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="heading px-2"><b>Fast Delivery</b></div>
                        </div>
                        <div class="col">
                            <div class="icon px-2 py-2" style="font-size: 30px;"><i class="fas fa-user-clock"></i></div>
                            <div class="heading px-2"><b>24x7 Support</b></div>
                        </div>
                    </div>
                    <div class="row pro-service-row">
                        <div class="col">
                            <div class="icon px-2 py-2" style="font-size: 30px;"><i class="fas fa-money-check-alt"></i>
                            </div>
                            <div class="heading px-2"><b>Easy Payment</b></div>
                        </div>
                        <div class="col">
                            <div class="icon px-2 py-2" style="font-size: 30px;"><i class="fas fa-box"></i></div>
                            <div class="heading px-2"><b>5 Days Replacement</b></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6 right-box">
           <h2 class="text-uppercase">  <?php echo $rowww["pname"]; ?>  </h2>

             <?php 
             if($rowww["offer"])
             {
                 echo
                '<h5> Special Offers </h5>
                <h5 class="off-percent">' . $rowww["offer"] .'% off</h5>
                <h3 class="product-price-strike">INR ' . number_format($rowww["pprice"]) .'/-</h3>
                <h3 class="product-price"> &nbsp; INR '.  number_format($discount) .'/-</h3>';
             }
             else
             {
                 echo '<h3 class="product-price"> INR ' . number_format($rowww["pprice"]) .'/-</h3>';
             }

             ?>
                <br>
                <p> <?php echo $rowww["description"]; ?> </p>
                <br>
                <i class="fas fa-truck"></i>
                <h4> Buyer Protection Guaranteed</h4>
                <br> <br>
                <?php  
                $uid=$_SESSION['uid']; 
                $discount = $rowww["pprice"] - (($rowww["pprice"]*$rowww["offer"])/100);
                $discount = intval($discount);
                echo '<form action="" class="form-submit">
                                
                                    <input type="hidden" class="form-control pqty" value="1">
                                    <input type="hidden" class="pid" value=" '.$rowww["pid"].' ">
                                    <input type="hidden" class="pname" value=" '.$rowww["pname"].' ">
                                    <input type="hidden" class="pprice" value=" '.$discount.' ">
                                    <input type="hidden" class="pimage" value=" '.$rowww["photo"].' ">
                <a href="cart.php?uid= '.$uid.'" class="btn addtomycart"> Add to Cart </a>
                </form>'; ?>
                <hr>
                <br>

                <div class="row">
                    <div class="pro-list-box">
                        <div class="col pro-list">
                            <ul>
                                <li>Category:</li>
                                <li>Tags:</li>
                                <li>Availability:</li>
                            </ul>
                        </div>
                        <div class="col pro-list">
                            <ul>
                                <li> <?php echo $rowww["category"]; ?> </li>
                                <li> <?php echo $rowww["tag"]; ?> </li>
                                <li> <?php echo $rowww["availability"]; ?> </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <?php echo '<a href="AddWishlist.php?pid='.$rowww["pid"].'" class="btn"> Add to Wishlist </a>'; ?>

            </div>
        </div>

<!-- ************************************************************************************************************************************** -->

        <h1 class="text-center vintage-heading" style="font-size:8rem;">Vintage begins here</h1>
        <h2 class="text-center py-5" style="text-decoration: 5px underline #c9b040;">RELATED PRODUCTS</h2>

        <?php
        $category = $rowww["category"];
        
        $sql = "Select * from products where category='$category'";
        $resultt = mysqli_query($conn, $sql);
        $roww = mysqli_fetch_assoc($resultt);

        echo'<div class="container">
        <div class="product-items">';

        foreach ($resultt as $roww) {
            if($roww["pid"] != $pid) {
            echo
            '<div class="product">
                <div class="product-content">
                    <div class="product-img">
                        <a href="Product.php?pid='.$roww["pid"].'" class="text-dark"><img src=" '.$roww["photo"].' " alt="product image"></a> 
                    </div>
                    <div class="product-btns " style="align-items: center;">';

                    $discountt = $roww["pprice"] - (($roww["pprice"]*$roww["offer"])/100);
                    $discountt = intval($discountt);

                    echo '<form action="" class="form-submit">            
                    <input type="hidden" class="form-control pqty" value="1">
                    <input type="hidden" class="pid" value=" '.$roww["pid"].' ">
                    <input type="hidden" class="pname" value=" '.$roww["pname"].' ">
                    <input type="hidden" class="pprice" value=" '.$discountt.' ">
                    <input type="hidden" class="pimage" value=" '.$roww["photo"].' ">
                    <a href="cart.php?uid= '.$uid.' "><button class="btn-cart addtomycart"><span><i class="fas fa-shopping-cart"></i></span></button></a>
                </form>


                        <button type="button" class="btn-wishlist">
                                <span><a href="AddWishlist.php?pid='.$roww["pid"].'" class="text-dark"><i class="fas fa-heart"></i></a></span>
                                </button>
                                <button type="button" class="btn-wishlist">
                                    <span><a href="Product.php?pid='.$roww["pid"].'" class="text-dark"><i
                                                class="fas fa-eye"></i></a></span>
                                </button>


                    </div>
                </div>

                <div class="product-info">
                    <div class="product-info-top">
                        <h2 class="sm-title">Rating</h2>
                        <div class="rating">';

                        for($i=0; $i<$roww["rating"]; $i++) {
                            echo '<span><i class="fas fa-star"></i></span>'; }

                            for($i=0; $i<5-$roww["rating"]; $i++) {
                            echo '<span><i class="far fa-star"></i></span>';  }

                        echo '</div>
                    </div>
                    <a href="#" class="product-name"> '.$roww["pname"].' </a>';
                    
                    if($roww["offer"])
                    {
                        $discount = $roww["pprice"] - (($roww["pprice"]*$roww["offer"])/100);
                        $discount = intval($discount);
                        echo'
                    <p class="product-price-strike"> INR '. number_format($roww["pprice"]) .'/-</p>
                    <p class="product-price"> INR '. number_format($discount) .'/-</p>';

                    }
                    else
                    {
                        echo '<p class="product-price"> INR '. number_format($roww["pprice"]) .'/-</p>';
                    }
                echo
                '</div>';
                
                if($roww["offer"]) { echo'
                <div class="off-info">
                    <h2 class="sm-title">25% off</h2>
                </div>'; }
                echo
            '</div>';
                }
            }
            echo '</div>
            </div>';
            ?>
    </main>


    <!-- ************************************************************************************************** -->

    <!-- footer section -->
  <?php include 'footer.php'; ?>


    <!-- My JS file -->

    <script src="assests/js/main.js"></script>
    <script src="assests/js/typing.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

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
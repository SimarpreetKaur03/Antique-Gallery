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
        $_SESSION["ViewWishlistAlert"] = true;
        header("Location:index.php");
    }

    $uid = $_GET['uid'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Wishlist</title>

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
    <link rel="stylesheet" href="assests/css/style.css">
    <link rel="stylesheet" href="assests/css/Product.css">

</head>

<body>

    <!-- header section -->
    <header id="topheader">

        <?php include 'header.php'; ?>

        <!-- ************************************************************************************************** -->
        <?php 
    if($_SESSION['wishlistAdded'])
    {
        $_SESSION['wishlistAdded'] = false;
        echo '<div class="alert text-center alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
  Item added to your wishlist!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($_SESSION['AlreadyWishlist'])
    {
        $_SESSION['AlreadyWishlist'] = false;
        echo '<div class="alert text-center alert-warning alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
  Item already exist in your Wishlist!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($_SESSION['wishlistRemoved'])
    {
        $_SESSION['wishlistRemoved'] = false;
        echo '<div class="alert text-center alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
  Item removed from your Wishlist!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($_SESSION['wishlistRemovedAll'])
    {
        $_SESSION['wishlistRemovedAll'] = false;
        echo '<div class="alert text-center alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
  All Items removed from your Wishlist!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    ?>
        <!-- ************************************************************************************************** -->

        <?php include 'login_signup.php'; ?>

        <div id="cart-message"></div>

    </header>
    <!-- header section ends -->


    <!-- ************************************************************************************************** -->
    <main>

    <?php 
       $sql = "select * from wishlist where uid='$uid'";
       $result = mysqli_query($conn,$sql);  
       $num_row = mysqli_num_rows($result); 

       if(!$num_row)
       {
           echo '<div align="center" style="margin-top:220px;"><img src="assests/images/empty_wishlist.png" alt="empty wishlist" style="width:50%" class="img-fluid" ></div>';
       }
       if($num_row) :
       ?>


        <h1 class="text-center mb-5" style="font-size:3rem;margin-top:220px;color:var(--gold);">Wishlist <i class="fas fa-heart"></i> </h1>
        
        <a href="RemoveWishlist.php?uid=<?= $uid?>" class="bg-danger text-white px-3 py-3" onclick="return confirm('Are you sure want to remove all items?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Wishlist</a>

        
        <section class="py-5">
            <div class="container">
                <div class="product-items">
       
       <?php
       while ($roww = mysqli_fetch_assoc($result)):
        
           $pid = $roww['pid'];
           $sqll = "select * from products where pid='$pid'";
           $resultt = mysqli_query($conn,$sqll);
           $rowww = mysqli_fetch_assoc($resultt);
           $uid = $_SESSION['uid'];
?>
           
                    <div class="product">
                        <div class="product-content">
                            <div class="product-img">
                                <img src=" <?=$rowww["photo"]?> " alt="product image">
                            </div>
                            <div class="product-btns " style="align-items: center;">

                                <button type="button" class="btn-cart">
                                    <span><a href="RemoveWishlist.php?pid=<?=$rowww["pid"]?>" class="text-white" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a></span>
                                </button>

                                <?php $discount = $rowww["pprice"] - (($rowww["pprice"]*$rowww["offer"])/100);
                                $discount = intval($discount); ?>

                                <form action="" class="form-submit">
                                
                                    <input type="hidden" class="form-control pqty" value="1">
                                    <input type="hidden" class="pid" value=" <?=$rowww["pid"]?> ">
                                    <input type="hidden" class="pname" value=" <?=$rowww["pname"]?> ">
                                    <input type="hidden" class="pprice" value=" <?=$discount?> ">
                                    <input type="hidden" class="pimage" value=" <?=$rowww["photo"]?> ">
                                    <a href="cart.php?uid= <?=$uid?> "><button class="btn-buy addtomycart"><span><i class="fas fa-shopping-cart"></i></span></button></a>
                                </form>

                                <button type="button" class="btn-wishlist">
                                    <span><a href="Product.php?pid=<?= $rowww["pid"] ?>" class="text-dark"><i
                                                class="fas fa-eye"></i></a></span>
                                </button>
                            </div>
                        </div>

                        <div class="product-info">
                            <div class="product-info-top">
                                <h2 class="sm-title">Rating</h2>
                                <div class="rating">
                                <?php for($i=0; $i<$rowww["rating"]; $i++) {
                                    echo '<span><i class="fas fa-star"></i></span>'; }

                                    for($i=0; $i<5-$rowww["rating"]; $i++) {
                                    echo '<span><i class="far fa-star"></i></span>';  } ?>
                                </div>
                            </div>
                            <a class="product-name"> <?= $rowww["pname"] ?> </a>
                            
                            <?php
                            if($rowww["offer"])
                            {
                                $discount = $rowww["pprice"] - (($rowww["pprice"]*$rowww["offer"])/100);
                                $discount = intval($discount);
                                echo'
                            <p class="product-price-strike"> INR '. number_format($rowww["pprice"]) .'/-</p>
                            <p class="product-price"> INR '. number_format($discount) .'/-</p>';

                            }
                            else
                            {
                                echo '<p class="product-price"> INR '. number_format($rowww["pprice"]) .'/-</p>';
                            }
                            ?>
                        </div>
                        
                        <?php
                        if($rowww["offer"]) { echo'
                        <div class="off-info">
                            <h2 class="sm-title">25% off</h2>
                        </div>'; }
                        ?>
                        
                    </div>
                    <?php endwhile; ?>
                    </div>
            </div>
        </section>

        <?php endif; ?>


        <!-- ************************************************************************************************** -->

        <!-- footer section -->
        <?php include 'footer.php'; ?>
    </main>

    <!-- My JS file -->

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
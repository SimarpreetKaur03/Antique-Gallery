<?php
//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );

include '_dbConnect.php';

$category = $_GET['category'];
$uid = $_SESSION['uid'];

// Start the session
session_start();

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

    <title>Product Gallery</title>
</head>


<body>
    <!-- header section -->
    <header id="topheader">

    <?php include 'header.php'; ?>
    <?php include 'login_signup.php'; ?>

    <div id="cart-message"></div>

    </header>
    <!-- header section ends -->
        

    <!-- ******************************************************************************************************** -->

    <main>
        <h1 class="text-center headingPro" style="font-size:8rem;">Product Gallery</h1>
        <h4 class="text-center">Not Unique, Just Antique!</h4>

        <section class="py-5">
            <h1 class="text-center mb-5" style="text-decoration: underline 5px #c9b040;"> <?php echo strtoupper($category); ?> </h1>
            <div class="container">
                <div class="product-items">


                    <!-- single product -->
                    <?php  
                    
                    $sql = "SELECT * FROM `products` WHERE `category`='$category'";
                    $result = mysqli_query($conn, $sql);
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
                            <a href="#" class="product-name"> '.$row["pname"].' </a>';
                            
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
                    <!-- end of single product -->
                    </div>
            </div>
        </section>    

        <!-- footer section -->
        <?php include 'footer.php'; ?>
    </main>


    <script src="assests/js/main.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>



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
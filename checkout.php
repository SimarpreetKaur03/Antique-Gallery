<?php

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );

include '_dbConnect.php';

// Start the session
session_start();


	$grand_total = 0;
	$allItems = '';
	$items = [];

    $uid = $_SESSION['uid'];

	$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart WHERE uid='$uid'";
	$result = mysqli_query($conn, $sql);
                    
	while ($row = mysqli_fetch_assoc($result)) {
        
        $grand_total += $row['total_price'];
	    $items[] = $row['ItemQty'];
	}
	$allItems = implode( "<br>" , $items);

    $oid = mt_rand(1111,9999);
    $_SESSION['oid'] = $oid;

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

    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />


    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <link rel="stylesheet" href="assests/css/style.css">
    <link rel="stylesheet" href="assests/css/Product.css">

    <title>Checkout</title>

</head>


<body>

    <!-- header section -->
    <header id="topheader" >

    <?php include 'header.php'; ?>
    <?php include 'login_signup.php'; ?>

    </header>
    <!-- header section ends -->


    <!-- ******************************************************************************************************** -->


    <div class="container" style=' margin-top: 160px'>
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4" id="order">
                <h2 class="text-center p-2">Complete your order!</h2>
                <div class="jumbotron p-3 mb-2 text-center">
                    <h6 class="lead"><b>Product(s) : </b><?php echo $allItems; ?></h6>
                    <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
                    <h5><b>Total Amount Payable : </b><?= number_format($grand_total,2) ?>/-</h5>
                </div>

                <form action="pgRedirect.php" method="post" id="placeOrder">


                    <input type="hidden" name="products" class="form-control" value="<?= $allItems; ?>">
                    <input type="hidden" name="TXN_AMOUNT" class="form-control" value="<?= $grand_total; ?>">
                    <input type="hidden" name="ORDER_ID" class="form-control" value="<?php echo'OD'.$oid; ?>">
                    <input type="hidden" name="CUST_ID" class="form-control" value="<?php echo'CUST'.$uid; ?>">
                    <input type="hidden" name="INDUSTRY_TYPE_ID" class="form-control" value="Retail" />
                    <input type="hidden"  name="CHANNEL_ID" class="form-control" value="WEB"/>
                    <input type="hidden" name="CALLBACK_URL" class="form-control" value="http://localhost/AntiqueGallery/pgResponse.php"/>
                    
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" value="<?= $_SESSION['uname']?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" value="<?= $_SESSION['email']?>"  required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control" placeholder="Enter Contact Number" required>
                    </div>
                    <div class="form-group">
                        <textarea name="address" class="form-control" rows="3" cols="10"
                            placeholder="Enter Delivery Address Here..."></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Place Order" class="btn btn-success btn-block">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- footer section -->
    <?php include 'footer.php'; ?>

    <script src="assests/js/main.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

    <script type="text/javascript">
    $(document).ready(function() {


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
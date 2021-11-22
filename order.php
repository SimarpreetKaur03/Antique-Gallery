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

$uid = $_GET['uid'];

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
    <link rel="stylesheet" href="assests/css/ProPage.css">

    <title>Order History</title>

</head>


<body>

    <!-- header section -->
    <header id="topheader">

        <?php include 'header.php'; ?>

        <?php 
        if($_SESSION['clearOrder']) {
            $_SESSION['clearOrder'] = false;
            echo '<div class="alert text-center alert-warning alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
            Order History Cleared!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }  ?>

        <?php include 'login_signup.php'; ?>

    </header>
    <!-- header section ends -->


    <!-- ******************************************************************************************************** -->
<main>

   <section style="margin-top:220px">

    

   <?php 
   $uid = $_SESSION['uid'];
   $sql = "select * from orderhistory where uid='$uid' order by date desc";
   $result = mysqli_query($conn,$sql);

   $num_row = mysqli_num_rows($result); 

       if(!$num_row)
       {
           echo '<div align="center" class="mt-5"><img src="assests/images/order.jpg" alt="empty wishlist" style="width:50%" class="img-fluid" ></div>';
       }
       if($num_row) : ?>
   
       <h1 class="text-center mb-5" style="color:var(--gold)">ORDER HISTORY</h1>
       <a href="clearOrder.php?uid=<?= $uid?>" class="bg-danger text-white px-3 py-3" onclick="return confirm('Are you sure want to clear your order history?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Order History</a>
  
       <?php
    while($row = mysqli_fetch_assoc($result)) : ?>
       
    <div class="mx-5 py-5" style="background: #fff1e3">
    <div class="text-center mx-5" style="font-size:2rem;">ORDER ID : <?= "OD".$row["oid"] ?></div>
    <div class="text-center mb-5 pb-5" style="font-size:1.5rem;">DATE : <?= $row["date"] ?></div>

    <?php $oid = $row['oid']; ?>

     <?php
     $sqll = "select * from checkoutProducts where uid='$uid' and oid='$oid'";
     $resultt = mysqli_query($conn,$sqll);
     $roww = mysqli_fetch_assoc($resultt);
     foreach($resultt as $roww) :
    ?>

    <?php 
    $pid = $roww['pid']; $pprice = $roww['product_price']; $qty = $roww['qty']; 
    $sqlll = "select * from products where pid='$pid'";
    $resulttt = mysqli_query($conn,$sqlll);
    $rowww = mysqli_fetch_assoc($resulttt); 
    ?>

    <div class="row mx-5">
    <div class="col-md-6" align="center"><img src="<?= $rowww['photo'] ?>" alt="product image" class="img-fluid" style="width:30%"></div>
    <div class="col-md-6 pt-4">
        <div><b><?= strtoupper($rowww['pname']) ?></b></div>
 
        <?php if($rowww['offer']){
            $discount = $rowww["pprice"] - (($rowww["pprice"]*$rowww["offer"])/100);
            $discount = intval($discount);
            echo'
        <h5 class="off-percent">' . $rowww["offer"] .'% off</h5>    
        <p class="product-price-strike"> INR '. number_format($rowww["pprice"]) .'/-</p>
        <p class="product-price"> INR '. number_format($discount) .'/-</p>';
        } 
        else
        {
            echo '<p class="product-price"> INR '. number_format($rowww["pprice"]) .'/-</p>';
        }?>

        <div>Quantity : <?= $qty ?></div>
    </div>
    </div> 
    <br> <br>
    <?php endforeach; ?> 

    <div class="mt-5 mx-5 text-center">Amount Paid : INR <?= number_format($row['amount_paid'],2) ?>/-</div>

    </div> <br> <br> <br>
   
   <?php endwhile; ?>  
   <?php endif; ?>

   </section>


  <!-- footer section -->
  <?php include 'footer.php'; ?>

</main>

<script src="assests/js/main.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

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
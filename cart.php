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
        $_SESSION["ViewCartAlert"] = true;
        header("Location:index.php");
    }

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

    <title>Cart</title>


</head>

<body>

    <!-- header section -->
    <header id="topheader">

        <?php include 'header.php'; ?>

        <?php
        if($_SESSION["cancel"])
        {
          $_SESSION["cancel"] = false;
          echo '<div class="alert text-center alert-warning alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
          Your PayPal Transaction has been Canceled!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        ?>

        <?php include 'login_signup.php'; ?>

    </header>
    <!-- header section ends -->


    <!-- ******************************************************************************************************** -->
<main>

<div id="cart-message"></div>
    <div class="container mb-4" style=' margin-top: 150px'>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                        echo $_SESSION['showAlert'];
                    } 
                    else {
                        echo 'none';
                    } 
                    unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    } unset($_SESSION['showAlert']); ?></strong>
                </div>
                <div class="table-responsive my-5">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <td colspan="7">
                                    <h4 class="text-center m-0" style="color: #c9b040">Products in your cart!</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>
                                    <a href="action.php?clear=all" class="badge-danger badge p-3 "
                                        onclick="return confirm('Are you sure want to clear your cart?');"><i
                                            class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $uid = $_SESSION['uid'];
                require '_dbConnect.php';
                
                $sql = "select * from cart where uid='$uid'";
                $result = mysqli_query($conn,$sql);
                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
              ?>
                            <tr>
                                <td class="align-middle"><?= $row['pid'] ?></td>
                                <input type="hidden" class="pid" value="<?= $row['pid'] ?>">
                                <td class="align-middle"><img src="<?= $row['product_image'] ?>" width="50"></td>
                                <td class="align-middle"><?= strtoupper($row['product_name']) ?></td>
                                <td class="align-middle">
                                    <i
                                        class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2); ?>
                                </td>
                                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                                <td class="align-middle">
                                    <input type="number" min="1" class="form-control itemQty" value="<?= $row['qty'] ?>"
                                        style="width:75px;">
                                </td>
                                <td class="align-middle"><i
                                        class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?>
                                </td>
                                <td class="align-middle">
                                    <a href="action.php?remove=<?= $row['pid'] ?>" class="text-danger lead"
                                        onclick="return confirm('Are you sure want to remove this item?');"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php $grand_total += $row['total_price']; ?>
                            <?php endwhile; ?>
                            <tr>
                                <td colspan="3">
                                    <a href="index.php#featured" class=" btn-lg btn-secondary btn-block"><i
                                            class="fas fa-cart-plus" style="text-decoration: none;" ></i>&nbsp;&nbsp;Continue
                                        Shopping</a>
                                </td>
                                <td colspan="2"><b>Grand Total</b></td>
                                <td><b><i
                                            class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b>
                                </td>
                                <td>
                                    <a href="checkout.php" class="btn btn-info align-middle <?= ($grand_total > 0) ? '' : 'disabled'; ?>" style="color: black; background-color: #c9b040; text-decoration: none;">
                                        <i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout 
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <!-- footer section -->
        <?php include 'footer.php'; ?>

</main>

<script src="assests/js/main.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

    <script type="text/javascript">
    $(document).ready(function() {

        // Change the item quantity
        $(".itemQty").on('change', function() {
            var $el = $(this).closest('tr');

            var pid = $el.find(".pid").val();
            var pprice = $el.find(".pprice").val();
            var qty = $el.find(".itemQty").val();
            location.reload(true);
            $.ajax({
                url: 'action.php',
                method: 'post',
                cache: false,
                data: {
                    qty: qty,
                    pid: pid,
                    pprice: pprice
                },
                success: function(response) {
                    console.log(response);
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
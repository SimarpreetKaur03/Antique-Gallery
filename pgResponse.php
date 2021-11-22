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

// Start the session
session_start();

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

include '_dbConnect.php';

    $uid = $_SESSION['uid'];
    $oid = $_SESSION['oid'];
    $name = $_SESSION["NAMEE"];
    $phone = $_SESSION["MSISDN"];
    $email = $_SESSION["EMAILL"];
    $address = $_SESSION["add"];
    $products = $_SESSION["allItems"];
    $grand_total = $_SESSION["total"];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payment Status</title>

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

<body>

<?php

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

$txn = "";


if($isValidChecksum == "TRUE") {
    
    if ($_POST["STATUS"] == "TXN_SUCCESS") {

        $txn = "Transaction Successful!";
        
        $sqll = "select * from cart where uid='$uid'";
        $resultt = mysqli_query($conn, $sqll);

    while($roww = mysqli_fetch_assoc($resultt))
    {
        $pid = $roww['pid'];
        $pprice = $roww['product_price'];
        $qty = $roww['qty'];
        $sqlll = "INSERT INTO `checkoutProducts` (`product_price`,`qty`,`uid`,`date`,`pid`,`oid`) VALUES ('$pprice','$qty','$uid',current_timestamp(),'$pid','$oid')";
        $resulttt = mysqli_query($conn, $sqlll);
    }

    $sqlll = "DELETE FROM `cart` WHERE `uid`='$uid'";
    $resulttt = mysqli_query($conn,$sqlll);

    if($grand_total) {
    $sqllll = "INSERT INTO `orderhistory` (`name`,`email`,`phone`,`address`,`products`,`amount_paid`,`date`,`oid`,`uid`) VALUES ('$name','$email','$phone','$address','$products','$grand_total',current_timestamp(),'$oid','$uid')";
	$resultttt = mysqli_query($conn,$sqllll); }

    
	$sqlll = "DELETE FROM `cart` WHERE `uid`='$uid'";
	$resulttt = mysqli_query($conn,$sqlll);  


	          echo '<div class="m-5 ">
								<h2 class="display-4 mt-2 text-center">Thank You!</h2>
								<h2 class="text-success text-center">Your Order Placed Successfully!</h2>
						  </div>';
        
    }
    else {
        $txn = "Transaction status is failure!";
        echo "<b class='text-danger mx-5'>Transaction status is failure</b>" . "<br/>";
    }

    if (isset($_POST) && count($_POST)>0 )
    { 
        foreach($_POST as $paramName => $paramValue) {
                echo "<div class='mx-5'><b>" . ucwords(strtolower($paramName)) . "</b> : " . $paramValue . "</div>";
                $data .= $paramName.' : '.$paramValue;
                $data.= "\n";
        }

        $to = $email;
        $subject = "Transaction Details by Galerie d'antiquités®";
        $txt = "Hi $name,\n".$txn."\n\nItems Purchases :\n".$products."\n\n".$data."\n"."\n\n\nGalerie d'antiquités®";
        $headers = "From: sk27102002@gmail.com". "\r\n" .
        "CC: skmdel07@gmail.com, harshitakamra392@gmail.com";
        $mailsent = mail($to,$subject,$txt,$headers);   

    }
    

}
else {
    echo "<b class='mx-5 mt-5'>Checksum mismatched.</b>";
    //Process transaction as suspicious.
}

echo '<br><br><a href="index.php#featured" style="text-decoration:none;" class="m-5 text-center"><b>Continue Shopping with Galerie d`antiquités®</b></a> <br><br>';

?>


<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

        

</body>

</html>
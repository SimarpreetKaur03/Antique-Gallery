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

$checkSum = "";
$paramList = array();

$ORDER_ID = $_POST["ORDER_ID"];
$CUST_ID = $_POST["CUST_ID"];
$INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
$CHANNEL_ID = $_POST["CHANNEL_ID"];
$TXN_AMOUNT = $_POST["TXN_AMOUNT"];
$CALLBACK_URL = $_POST["CALLBACK_URL"];

$_SESSION["NAMEE"] = $name = $_POST["name"];
$_SESSION["MSISDN"] = $phone = $_POST["phone"];
$_SESSION["EMAILL"] = $email = $_POST["email"];
$_SESSION["add"] = $address = $_POST["address"];
$_SESSION["allItems"] = $products = $_POST["products"];
$_SESSION["total"] = $grand_total = $TXN_AMOUNT;


// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = $CALLBACK_URL; 


$oid = $_SESSION["oid"];
$uid = $_SESSION["uid"];

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



//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
    <center><h1>Please do not refresh this page...</h1></center>
        <form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
        <table border="1">
            <tbody>
            <?php
            foreach($paramList as $name => $value) {
                echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
            }
            ?>
            <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
            </tbody>
        </table>
        <script type="text/javascript">
            document.f1.submit();
        </script>
    </form>
</body>
</html>
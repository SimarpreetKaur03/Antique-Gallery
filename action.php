<?php
	session_start();
	
	include '_dbConnect.php';

	// Add products into the cart table
	if (isset($_POST['pid']) ) {

		if( isset($_SESSION['uname']) ){
			$pid = $_POST['pid'];
			$pname = $_POST['pname'];
			$pprice = $_POST['pprice'];
			$pimage = $_POST['pimage'];
			$pqty = $_POST['pqty'];
			$total_price = $pprice * $pqty;


			$uid = $_SESSION['uid'];
			$sql = "select * from cart where pid='$pid' and uid='$uid'";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);

			if (!$row) {

				$sqll = "INSERT INTO `cart` (`pid`,`product_name`,`product_price`,`product_image`,`qty`,`total_price`,`uid`) VALUES ('$pid','$pname','$pprice','$pimage','$pqty','$total_price','$uid')";
				$resultt = mysqli_query($conn,$sqll);

				if($resultt)
                {
				echo '<div class="alert text-center alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
				Item added to your Cart!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				}
	
			} else {
			
				echo '<div class="alert text-center alert-warning alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
				<strong>Item already added to your cart!</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
			}
		}
		else{
			echo '<div class="alert text-center alert-warning alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
				<strong>Please login first to add items to your Cart!</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
		}

	  
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item'  && isset($_SESSION['uname'])) {

	$uid = $_SESSION['uid'];
	$sql = "select * from cart where uid='$uid'";
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($result);
	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $pid = $_GET['remove'];

	  $uid = $_SESSION['uid'];
	  $sqlll = "DELETE FROM `cart` WHERE `pid`='$pid' AND `uid`='$uid'";
	  $resulttt = mysqli_query($conn,$sqlll);

	  if($resulttt) {
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	  }
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $uid = $_SESSION['uid'];
	  $sqlll = "Delete from cart where uid='$uid'";
	  $resulttt = mysqli_query($conn,$sqlll);

	  if($resulttt) {
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	  }
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $uid = $_SESSION['uid'];
	  $sqlll = "update cart set qty='$qty', total_price='$tprice' where pid='$pid' and uid='$uid'";
	  $resulttt = mysqli_query($conn,$sqlll);

	}
	
?>

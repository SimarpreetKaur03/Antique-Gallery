<?php
//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );

// Start the session
session_start();
?>

<!doctype html>
<html lang="en">
  

<body>

    <nav class="navbar navbar-expand-lg  navbar-dark" aria-label="Tenth navbar example" 
    style="background: black;box-shadow: 0px 4px 8px rgb(0, 0, 0,0.5);">
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
              <a class="nav-link" href="index.php#deals">Deals</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="contact.php">Contact</a>
            </li>
          </ul>
        </div>
        <div>
        <div class="text-center" style="color:#c9b040"><?php if($_SESSION["uname"]) { echo 'Hello, ' . $_SESSION["uname"] . ' !'; } ?></div>
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
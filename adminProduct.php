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

if($_SESSION["delete"])
{
  $_SESSION["delete"] = false;
    echo '<div class="alert text-center alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
  Product Removed Successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(!$_SESSION["delete"] && $_SESSION["deleteAlert"])
{
  $_SESSION["deleteAlert"] = false;
    echo '<div class="alert text-center alert-danger alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
   <strong>Error!</strong> Product not found.
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';
}

if($_SESSION["add"])
{
  $_SESSION["add"] = false;
    echo '<div class="alert text-center alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
    Product Added Successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(!$_SESSION["add"] && $_SESSION["addAlert"])
{
  $_SESSION["addAlert"] = false;
    echo '<div class="alert text-center alert-danger alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
   <strong>Error!</strong>
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';
}

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

<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <title>Product Gallery</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto+Slab:wght@500&display=swap');
    *{
        font-family: "roboto slab";
    }
    table,
      th,
      td {
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
      }
      a {
        text-decoration: none;
      }
</style>
<body>  

<table class="mx-3 my-3">
    <tr>
        <td class="text-center" colspan="11"><a href="admin.php" style="font-size:3rem; color:#c9b040; text-decoration:none;">Galerie d'antiquités®</a></td>
    </tr>
  <tr>
    <th class="text-center">Id</th>
    <th class="text-center">Product Name</th>
    <th class="text-center">Price</th>
    <th class="text-center">Discount</th>
    <th class="text-center">Description</th>
    <th class="text-center">Category</th>
    <th class="text-center">Image</th>
    <th class="text-center">Availability</th>
    <th class="text-center">Tags</th>
    <th class="text-center">Rating</th>
    <th class="text-center">Product</th>
    <th>&nbsp</th>
  </tr>

  <?php  
                    
        $sql = "Select * from products";
        $result = mysqli_query($conn, $sql);
                    
        while ($row = mysqli_fetch_assoc($result)):
          ?>
    <tr>
    <td class="text-center"><?= $row["pid"] ?></td>
    <td class="text-center"><?= strtoupper($row["pname"]) ?></td>
    <td class="text-center">INR <?= number_format($row["pprice"],2) ?>/-</td>
    <td class="text-center"><?= $row["offer"] ?>%</td>
    <td class="text-center"><?= $row["description"] ?></td>
    <td class="text-center"><?= $row["category"] ?></td>
    <td class="text-center"><img src="<?= $row["photo"] ?>" alt="product image" style="width:80%"></td>
    <td class="text-center"><?= $row["availability"] ?></td>
    <td class="text-center"><?= $row["tag"] ?></td>
    <td class="text-center"><?= $row["rating"] ?></td>
    <td class="text-center"><?= ucwords($row["nf"]) ?></td>
    <td class="text-center"><a href="adminRemove.php?id=<?= $row["pid"] ?>" class="text-danger" onclick="return confirm('Are you sure want to remove this product?');"> <i class="fas fa-trash-alt"></i> </a></td>
  </tr>
  <?php endwhile; ?>
</table>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
    crossorigin="anonymous"></script>

</body>
</html>
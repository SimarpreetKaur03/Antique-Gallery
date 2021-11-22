<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
include '_dbConnect.php';

$pname = strtoupper($_POST["pname"]);
$price = $_POST["pprice"];
$offer = $_POST["offer"];
$rating = $_POST["rating"];
$description = $_POST["description"];
$category = $_POST["category"];
$category = strtolower($category);
$category = ucwords($category);
$tag = ucwords($_POST["tag"]);
$product = strtolower($_POST["newFeatured"]);
$top = strtolower($_POST["topcategory"]);
$photo = "assests/images/Products/".strtolower($category)."/".$_POST['photo'];
move_uploaded_file($_POST["photo"],$photo);

$sql = "Select * from products where pname='$pname'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$_SESSION["add"] = false;
$_SESSION["addAlert"] = false;

if(!$row){

$sql = "INSERT INTO `products` ( `pname`, `pprice`, `offer`, `description`, `category`, `tag`, `photo`, `availability`, `date`, `nf`, `rating`) VALUES ('$pname', '$price', '$offer', '$description', '$category', '$tag', '$photo', 'In Stock', current_timestamp(), '$product','$rating')";
$result = mysqli_query($conn, $sql);

$category = strtolower($category);
$sql = "select * from search where sname='$category'";
$resultt = mysqli_query($conn, $sql);
$roww = mysqli_fetch_assoc($resultt);

if(!$roww)
{
  $sql = "INSERT INTO `search` ( `sname`, `top`, `photo`) VALUES ('$category', '$top', '$name')";
  $resultt = mysqli_query($conn, $sql);
}
if($roww)
{
  $sql = "update search set top='$top' where sname='$category'";
  $resultt = mysqli_query($conn, $sql);
}

if ($result && $resultt){
  $_SESSION["add"] = true;
  }
else{
    $_SESSION["add"] = false;
    $_SESSION["addAlert"] = true;
    }
}
else{
  $_SESSION["add"] = false;
  $_SESSION["addAlert"] = true;
  }


header("Location:adminProduct.php");
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


<!-- css files -->
<!-- <link rel="stylesheet" href="assests/css/style.css"> -->
<link rel="stylesheet" href="assests/css/Product.css">
<link rel="stylesheet" href="assests/css/admin.css">

<title>Add Product</title>
</head>

<body>
    <div class="AddProduct text-center" style="box-shadow:  20px 20px 60px #bebebe, -20px -20px 60px #ffffff;">  
        <h3 class="pt-4"><a href="admin.php" style="color:var(--gold)">Galerie d'antiquités®</a></h3>
        <hr>
        <div class="d-flex align-items-stretch">
        <form action="adminAdd.php" method="POST">
        <div><input type="name" name="pname" class="box form-control" placeholder="Enter Product Name" required></div>
        <div class="row">
        <div class="col-md-4"><input type="number" name="pprice" class="box form-control" placeholder="Enter Product Price" required></div>
        <div class="col-md-4"><input type="number" name="offer" class="box form-control" placeholder="Enter Discount Percentage" required></div>
        <div class="col-md-4"><input type="number" name="rating" class="box form-control" placeholder="Enter Product Rating (1-5)" required></div>
        </div>
        <div><textarea placeholder="Enter Product Description" class="box form-control  py-1" name="description" rows="7" required></textarea></div>
        <div class="row">
        <div class="col-md-3"><input type="text" name="category" class="box form-control" placeholder="Enter Product Category" required></div>
        <div class="col-md-3"><input type="text" name="tag" class="box form-control" placeholder="Enter Product Tag" required></div>
        <div class="col-md-3"><input type="text" name="topcategory" class="box form-control" placeholder="Top Category (yes/no)" required></div>
        <div class="col-md-3"><input type="text" name="newFeatured" class="box form-control" placeholder="New/Featured"></div>
        </div>
        <p class="text-danger pt-5"><strong>Upload product image</strong></p>
        <div><input type="file" name="photo" class="box form-control"></div>
        <div class="d-flex flex-row align-items-center justify-content-center">
        <div><input type="submit" value="Add" class="btn mx-2"></div>
        <div><input type="reset" value="Reset" class="btn mx-2"></div>
        </div>
        </form>
        </div>
    </div>

    <script src="assests/js/main.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
  crossorigin="anonymous"></script>

</body>
</html>
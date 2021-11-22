<?php

include '_dbConnect.php';

if (isset($_POST['search'])) {

   $Name = $_POST['search'];
   $Name = strtolower($Name);

   $sql = "Select * from search where sname='$Name'";

   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($result);

  if($row)
  {
    $Name = ucwords($Name);
  header("Location:category.php?category=$Name");
  }
  else
  {
  header("Location:category.php?category=Other");
  }
}
?>
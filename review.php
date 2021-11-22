<?php 

//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );

// Start the session
session_start();

     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
     include '_dbConnect.php'; 
                
 if( isset($_SESSION['uname']) ){
     $name = $_POST['name'];
     $email = $_POST['email'];               
     $review = $_POST['review'];

     $_SESSION['review'] = false;
     $_SESSION['reviewAlert'] = false;
     $_SESSION['reviewLogin'] = false;

     $sqll = "INSERT INTO `ureviews` (`uname`, `email`, `review`,`date`) VALUES ('$name', '$email', '$review',current_timestamp())";
     $resultt = mysqli_query($conn, $sqll);

     if($resultt){
     $_SESSION['review'] = true;
     }
     else{
         $_SESSION['review'] = false;
         $_SESSION['reviewAlert'] = true;
     }
  }else{
     $_SESSION['reviewLogin'] = true;
     }

     header("Location:index.php#reviews");

 }
 ?>
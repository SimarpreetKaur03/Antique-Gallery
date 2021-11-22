<?php

session_start();

//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
ini_set('error_reporting', E_ALL );


if($_SERVER["REQUEST_METHOD"] == "POST"){

    include '_dbConnect.php';
    
    $email = $_POST["email"];
    $_SESSION['email'] = $email;
    $sql = "Select * from users where email='$email'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
	$name = $row['uname'];
    $num = mysqli_num_rows($result);

    $_SESSION["forgot"] = false;
    $_SESSION["mailsent"] = false;

    if($num){
        $otp = mt_rand(111111,999999);
        $_SESSION["otp"] = $otp;
        $sql = "select * from resetpassword where email='$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if(!$row) {
            $sql = "INSERT INTO `resetpassword` ( `email`, `otp`, `date`) VALUES ('$email', '$otp',current_timestamp())";
            $result = mysqli_query($conn, $sql);
        }
        else {
            $sql = "update resetpassword set otp='$otp' where email='$email'";
            $result = mysqli_query($conn, $sql);
        }
        if($result)
        {
                $to = $email;
                $subject = "OTP verification by Galerie d'antiquités®";
                $txt = "Hi $name, looks like you have locked yourself out!\n\nNo issues, the OTP to verify your account is $otp.\nHave a great day! \n\nGalerie d'antiquités®";
                $headers = "From: sk27102002@gmail.com". "\r\n" .
                "CC: skmdel07@gmail.com, harshitakamra392@gmail.com";
                $mailsent = mail($to,$subject,$txt,$headers);
                if($mailsent)
                {
                    $_SESSION["mailsent"] = true;
                    header("Location:OTP.php");
                }
        }
        
    }
    else {
        $_SESSION["forgot"] = true;
        header("Location:index.php");
    }
    
} 

?>    
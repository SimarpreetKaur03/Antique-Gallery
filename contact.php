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



<head>

    <title>Contact US</title>

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
    <link rel="stylesheet" type="text/css" href="assests/css/contact.css">
    <link rel="stylesheet" href="assests/css/style.css">
    <link rel="stylesheet" href="assests/css/Product.css">


    <style>
        
    .slider {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: -1;
        background: linear-gradient(to right, rgb(8, 8, 8), rgb(121, 104, 31), rgb(180, 160, 46), rgb(255, 246, 196));
        margin-top: 5%;
        margin-bottom: 2%;
    }

    section {
        display: flex;
        height: 80vh;
        justify-content: center;
        align-items: center;
        margin-top: 5%;
        margin-bottom: 2%;
    }

    .hero {
        height: 60%;
        width: 100%;
        position: relative;
    }

    .hero img {
        height: 100%;
        width: 100%;
        /* max-width:100%; */
        /* height:auto; */
        object-fit: cover;
    }

    .hero::after {
        content: "";
        background: black;
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0.3;
    }

    .headline {
        position: absolute;
        top: 70%;
        left: 10%;
        font-size: 4rem;
        color: white;
        transform: translate(-20%, -70%);
        z-index: 3;
        font-family: 'Birthstone', cursive!important;
        text-shadow: 0.2rem 0.2rem black;
    }
    </style>

</head>

<body>

    <header id="topheader">

        <?php include 'header.php'; ?>

        <!-- *************************************************************************************************************************************** -->
        <!-- *************************************************************************************************************************************** -->
        <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_dbConnect.php'; 
    
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subjectt = $_POST['subject'];
  $message = $_POST['message'];

  $sql = "INSERT INTO `contacts` (`name`, `email`, `subject`, `message`, `date`) VALUES ('$name', '$email', '$subjectt', '$message', current_timestamp())";
  $result = mysqli_query($conn, $sql);

  if($result){
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert" style="z-index:1000;">
    <strong>Thankyou for contacting us!</strong> Your entry has been submitted successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  else{
      echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert" style="z-index:1000">
      <strong>Error!</strong> We are facing some technical issue and your entry is not submitted successfully! We regret the inconvinience caused!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }

        $to = "saloniie27@gmail.com";
        $subject = $subjectt;
        $txt = $message."\n\n".$name;
        $headers = "From: ".$email. "\r\n" .
        "CC: skmdel07@gmail.com, harshitakamra392@gmail.com, $email";
        $mailsent = mail($to,$subject,$txt,$headers);

}

?>
        <!-- *************************************************************************************************************************************** -->
        <!-- *************************************************************************************************************************************** -->

        <?php include 'login_signup.php'; ?>

    </header>
    <!-- header section ends -->

    <main>

        <section>
            <div class="hero">
                <img src="assests/images/contactrecord2.jpg">
                <h1 class="headline"><strong>Dream Antique</strong></h1>
            </div>
        </section>
        <div class="slider">

        </div>

        <div class="row">
            <div class="col-lg-6 left1">
                <h1 class="contact-row-heading">i see it,<br>i like it,<br>i want it,<br>i got it.<br>yeah!</h1>
            </div>
            <div class="col-lg-6 right1">
                <div>
                    <p style="font-size: 1.6rem;"><strong>Galerie d'antiquités<sup>®</sup></strong></p>
                    <p>Shri Guru Tegh Bahadur Khalsa College,<br />
                        University Of Delhi,<br />
                        Arts Faculty Rd,<br /> University Enclave,<br />
                        New Delhi, Delhi 110007<br />
                    </p>
                    <a href="tel:+61396963777">+91 xxxxxxxxxx</a><br />
                    <a href="mailto:harshitakamra392@gmail.com">Antiquegallery@antique.com</a>
                    </p>
                </div>

                <div class="contact">
                    <div class="d-flex align-items-stretch">
                        <form action="contact.php" method="POST" name="EmailForm">
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <input type="text" name="name" placeholder="Your Name" class="form-control"
                                        id="name" style="background: transparent;color:black;" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" placeholder="Your Email" class="form-control" name="email"
                                        id="email" style="background: transparent;color:black;" required>
                                </div>

                            </div>

                            <div class="form-group">
                                <input type="text" placeholder="Subject" class="form-control" name="subject"
                                    id="subject" style="background: transparent;color:black;" required>
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Message" class="form-control" name="message" rows="7"
                                    style="background: transparent;color:black;" required></textarea>
                            </div>
                            <div class="buttons d-flex flex-row align-items-center justify-content-center">
                                <div class="px-lg-2"><button type="submit">Send</button></div>
                                <div class="px-2"><button type="reset">Reset</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6 left2">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3499.7906774917033!2d77.20702441503781!3d28.695907582392763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfdec341ff0dd%3A0xb88fdcff217259a7!2sShri%20Guru%20Tegh%20Bahadur%20Khalsa%20College!5e0!3m2!1sen!2sin!4v1633094965750!5m2!1sen!2sin"
                    width="600" height="450" style="border:0; " allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-lg-6 right2">
                <img style="width: 100%; height: 100vh; max-width:100%;height:auto;" src="assests/images/contact.jpg">
            </div>
        </div>
    </main>

    <!-- footer section -->
    <?php //include 'footer.php'; ?>


    <script src="assests/js/main.js"></script>
    <!-- <script src="assests/js/contact.js"></script> -->

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Tweenmax links for animation -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"
        integrity="sha512-DkPsH9LzNzZaZjCszwKrooKwgjArJDiEjA5tTgr3YX4E6TYv93ICS8T41yFHJnnSmGpnf0Mvb5NhScYbwvhn2w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TimelineMax.min.js"
        integrity="sha512-0xrMWUXzEAc+VY7k48pWd5YT6ig03p4KARKxs4Bqxb9atrcn2fV41fWs+YXTKb8lD2sbPAmZMjKENiyzM/Gagw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
    const hero = document.querySelector('.hero');
    const slider = document.querySelector('.slider');
    const headline = document.querySelector('.headline');


    const mytimeline = new TimelineMax();

    mytimeline.fromTo(
        hero, 
        1, 
        { height: "0%" }, 
        { height: "80%", ease: Power2.easeInOut }
    )
    .fromTo(
        hero, 
        1.2,
        { width: "100%" }, 
        {   width: "80%", ease: Power2.easeInOut}
    )
    .fromTo(
        slider, 
        1,
        { x: "-100%" }, 
        { x: "0%", ease: Power2.easeInOut},
        "-=1"
    )
    .fromTo(
        headline, 
        1,
        { opacity: "0.4", x: "30%" }, 
        { opacity: "1", x: "0%", ease: Power2.easeInOut},
        "-=1"
    )



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
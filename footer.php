<!DOCTYPE html>
<html lang="en">
<body>
    
<section class="footer">
      <div class="box-container row px-5 py-5">

        <div class="boxx first col-lg-3 py-3 px-5 text-center">
          <h3 class="text-uppercase">about us</h3>
          <p>For the love of Antiques, we at Galerie d'antiquités® are providing you so many services from your tiny
            litle screen anywhere and anytime you want. Now you can express your love for these beautiful antique pieces
            just by clicking some buttons right from your home.</p>
        </div>
        <div class="boxx col-lg-3 d-flex flex-column text-center text-uppercase py-3">
          <h3>quick links</h3>
          <a href="index.php#home" class="py-1">home</a>
          <a href="index.php#services" class="py-1">services</a>
          <a href="index.php#deals" class="py-1">deals</a>
          <a href="index.php#reviews" class="py-1">review</a>
          <a href="contact.php" class="py-1">contact</a>
        </div>
        <div class="boxx col-lg-3 d-flex flex-column text-center text-uppercase py-3">
          <h3>Categories</h3>
          <?php
                include '_dbConnect.php';
                $sql = "select * from search";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                    
                    foreach ($result as $row) {
                    echo'
                <a class="py-1" href="category.php?category='.ucwords($row["sname"]).'">'.ucwords($row["sname"]).'</a>'; } ?>
        </div>
        <div class="boxx col-lg-3 d-flex flex-column text-center py-3">
          <h3 class="text-uppercase">contact us</h3>
          <p> <i class="fas fa-home"></i>
                        University Enclave,<br>
                        New Delhi, Delhi 110007
          </p>
          <p> <i class="fas fa-phone"></i>
            +91 xxxxxxxxxx
          </p>
          <p> <i class="fas fa-envelope"></i>
            antiquegallery@antique.com
          </p>
          <p> <i class="fas fa-clock"></i>
            Opening hours <br>
            Monday - Friday, 10am - 6pm
          </p>
        </div>

      </div>

      <div class="mb-0">
      <h1 class="credit text-center text-uppercase pb-3 px-2"> © 2021 Galerie d'antiquités® | All Rights Reserved</h1>

      <div class="d-flex flex-row justify-content-center align-items-center icon-box pb-5">
            <a href=""><i class="fab fa-linkedin-in px-1" style="font-size: 1.3rem;"></i></a>
            <a href=""><i class="fab fa-instagram px-1" style="font-size: 1.3rem;"></i></a>
            <a href=""><i class="fab fa-twitter px-1" style="font-size: 1.3rem;"></i></a>
            <a href=""><i class="fab fa-facebook-f px-1" style="font-size: 1.3rem;"></i></a>
          </div>
        </div> 
    </section>

</body>
</html>
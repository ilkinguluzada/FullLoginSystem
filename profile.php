<?php
/* Profil php */
session_start();

// userin daxil olub olmadihgini oyrenirirk
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Oxunaqligi artirir
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title> <?= $first_name.' '.$last_name ?>, Xoş Gəlmisiniz!</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
  <div class="form">

          <h1>Xoş Gəlmisiniz</h1>
          
          <p>
          <?php 
     
          // tesdiqlenme haqqinda mesaj
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // istifadecini bezdirmemek ucun refreshden sonra unset
              unset( $_SESSION['message'] );
          }
          
          ?>
          </p>
          
          <?php
          
          // hesab tesdiqlenmeyib
          if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
              </div>';
          }
          
          ?>
          
          <h2><?php echo $first_name.' '.$last_name; ?></h2>
          <p><?= $email ?></p>
          
          <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>

    </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>

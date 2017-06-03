<?php
/* Unudulmush shifre ucun forgot.php 
*/

require 'db.php';
session_start();

//email ve hash bosh olub olmadigini yoxla
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) ){

  $email = mysqli_real_escape_string($conn, $_GET['email']);

  $hash mysqli_real_escape_string($conn, $_GET['hash']);

  //Bele bir istifadeci varmi?
  $sql = "SELECT * FROM users WHERE email = '$email' AND email = '$hash'";

  $result = mysqli_query($conn, $sql);

  //0-dan coxdursa demeli var
  if (mysqli_num_rows($result) == 0) {
        $_SESSION['message'] = 'Şifrəni yeniləmək üçün link doğru deyil.'
        header('Location: error.php');
           }
 
}

else{

  $_SESSION['message'] = 'Ups. Parametrlər doğru deyil. Yenidən Cəhd Edin.'
  header('Location: error.php');

}


?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Unudulmuş Şifrəni Yenilə/title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    <div class="form">

          <h1>Yeni Şifrəni Seç</h1>
          
          <form action="reset_password.php" method="post">
              
          <div class="field-wrap">
            <label>
              Yeni Şifrə<span class="req">*</span>
            </label>
            <input type="password"required name="newpassword" autocomplete="off"/>
          </div>
              
          <div class="field-wrap">
            <label>
              Təkrar<span class="req">*</span>
            </label>
            <input type="password"required name="confirmpassword" autocomplete="off"/>
          </div>
          
          <!-- Gizledilmish email -->
          <input type="hidden" name="email" value="<?= $email ?>">    
          <input type="hidden" name="hash" value="<?= $hash ?>">       
              
          <button class="button button-block"/>Davam Et</button>
          
          </form>

    </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>

<?php 
/* Reset your password form, sends reset.php password link */

require 'db.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

$email = mysqli_real_escape_string($conn, $_POST['email']);

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);


//Belə Bir istifadəçi varmı?
if (mysqli_num_rows($result) == 0) {
    
    $_SESSION['message'] = "Sistemdə belə bir istifadəçi tapılmadı!";
  header("Location: error.php");
    
} else {

  $user = mysqli_fetch_assoc($result);

  $email = $user["email"];
  $hash = $user["hash"];
  $first_name = $user["first_name"];

  $_SESSION['message'] = "<p>Şifrənizi yeniləmək üçün <span>$email</span> ünvanına link göndərilmişdir. </p>!";

  //Qeydiyyat tesdiqleme linki gonder (verify.php)
  $to = $email;
  $subject = 'Unudulmuş Şifrə';
  $message_body ='Salam' . $first_name . ', 
  Şifrənizi yeniləmək üçün sorğu göndərmisiniz!

  Şifrənizi yeniləmək üçün <a href="http://localhost/loginsystem/reset.php?email'. $email . '&hash='.$hash . '" >Yeniləmə Linki. </a>';

  mail($to, $subject, $message_body);

  header("Location: success.php");

  }

}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Your Password</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
    
  <div class="form">

    <h1>Reset Your Password</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        Email Address<span class="req">*</span>
      </label>
      <input type="email" required autocomplete="off" name="email"/>
    </div>
    <button class="button button-block"/>Reset</button>
    </form>
  </div>
          
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>

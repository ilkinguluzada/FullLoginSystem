<?php
/* Butun Error Mesajlarini Goster */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Uğursuz</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
<div class="form">
    <h1>Error</h1>
    <p>
     <?php 

        if(isset($_SESSION['message']) && !empty($_SESSION['message'])):
        	echo $_SESSION['message'];
        else:
        	header("Location: index.php");
        endif;
    ?>
    </p>     
    <a href="index.php"><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>

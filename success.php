<?php
/*Ugurlu mesajlari goster */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Uğurlu</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
<div class="form">
    <h1><?= 'Success'; ?></h1>
    <p>
    <?php 
        if( isset($_SESSION['message']) AND !empty($_SESSION['message'])):
        	echo $_SESSION['message'];
        else:
        	header("Location: index.php");
        endif;
    ?>

    </p>
    <a href="index.php"><button class="button button-block"/>Əsas Səhifə</button></a>
</div>
</body>
</html>

<?php
/* Shifreni yenilemek */
require 'db.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    // eyni shifre daxil dilib
    if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) { 

        $new_password = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
        
        // Gizlədilmiş inputlardan email və hash kodu götürürük
        $email = $mysqli->escape_string($_POST['email']);
        $hash = $mysqli->escape_string($_POST['hash']);
        
        $sql = "UPDATE users SET password='$new_password', hash='$hash' WHERE email='$email'";

        if ( $mysqli->query($sql) ) {

        $_SESSION['message'] = "Şifrə Yeniləndi!";
        header("location: success.php");    

        }

    }
    else {
        $_SESSION['message'] = "Şifrələr uyğun deyil!";
        header("location: error.php");    
    }

}
?>
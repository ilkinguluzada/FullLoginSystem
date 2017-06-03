<?php
/* İstifadecinin daxil olmagi */

$email = mysqli_real_escape_string($conn, $_POST['email']);

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);


//Belə Bir istifadəçi varmı?
if (mysqli_num_rows($result) ==0) {
    
    $_SESSION['message'] = "Sistemdə belə bir istifadəçi tapılmadı!";
	header("Location: error.php");
    
} else {

	$user = mysqli_fetch_assoc($result);

	if(password_verify($_POST['password'], $user['password'])){

		$_SESSION['email'] = $user['email'];
		$_SESSION['first_name'] = $user['first_name'];
		$_SESSION['last_name'] = $user['last_name'];
		$_SESSION['active'] = $user['email'];


		//daxil olub
		$_SESSION['logged_in'] = true;

		header('Location: profile.php');
	}

	else{

		$_SESSION['message'] = "Daxil etdiyiniz məlumatlar doğru deyil!";
	header("Location: error.php");

	}
    
}
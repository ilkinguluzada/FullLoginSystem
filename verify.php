<?php 
/* Istifadecinin Qeydiyyatini Tesdilemek Ucun
*/

require 'db.php';
session_start();

//email ve hash bosh olub olmadigini yoxla
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) ){

	$email = mysqli_real_escape_string($conn, $_GET['email']);

	$hash mysqli_real_escape_string($conn, $_GET['hash']);

	//Hesablari aktiv olmayan istifadecileri sec
	$sql = "SELECT * FROM users WHERE email = '$email' AND email = '$hash' AND active = '0'";

	$result = mysqli_query($conn, $sql);

	//0-dan coxdursa demeli var
	if (mysqli_num_rows($result) == 0) {
	    	$_SESSION['message'] = 'Hesab artıq aktivləşdirilib və ya link doğru deyil.'
	    	header('Location: error.php');
	    	   }
	else{

		$sql = "UPDATE users SET active='1' WHERE email='$email'";

		mysqli_query($conn, $sql) or die(mysql_error());

		$_SESSION['active'] = 1;
		header("Location: success.php");
	}
}

else{

	$_SESSION['message'] = 'Daxil olunan parametrlər doğru deyil.'
	    	header('Location: error.php');

}
<?php
/* Qeydiyyat Prosesi. Istifadecini Yaradir ve tesdiqleme mesaji gonderir
 */

//Profile.php ucun Sessionu ELave Edirik
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['last_name'] = $_POST['last_name'];


//SQL injection Ucun Escape
$first_name = mysqli_real_escape_string($conn, $_POST['firstname']);

$last_name = mysqli_real_escape_string($conn, $_POST['lastname']);

$email = mysqli_real_escape_string($conn, $_POST['email']);

$password = mysqli_real_escape_string($conn, password_hash($_POST['password'], PASSWORD_BCRYPT));

$hash = mysqli_real_escape_string($conn, md5(rand(0, 1000)));

//Emailin Databazada Olub Olmamagini Yoxluyuruq
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

//0-dan coxdursa demeli var
if (mysqli_num_rows($result) > 0) {
    	$_SESSION['message'] = 'Bu e-mail ünvanı ilə istifadəçi artıq mövcuddur.';
    	header('Location: error.php');
   }
 else {

	$sql = "INSERT INTO users (first_name, last_name, email, password, hash)
VALUES ('$first_name', '$last_name', '$email', '$password', '$hash')";

if (mysqli_query($conn, $sql)) {
    
	$_SESSION['active'] = 0; //Emaille Aktiv edecek
	$_SESSION['logged_in'] = true; //daxil olub
	$_SESSION['message'] = 
	'Qeydiyyatı tamamlamaq üçün e-mail ünvanınızı təsdiqləməlisiniz. Təsdiqləmək üçün e-mail ünvanınıza göndərilən linkə daxil olun.';

	//Qeydiyyat tesdiqleme linki gonder (verify.php)
	$to = $email;
	$subject = 'Qeydiyyat Təsdiqlənməsi';
	$message_body ='Salam' . $first_name . ', 
	Qeydiyyatdan keçdiyiniz üçün təşəkkürlər!

	Qeydiyyatı tamamlamaq üçün <a href="http://localhost/loginsystem/verify.php?email'. $email . '&hash='.$hash . '" >Təsdiqləmə Linki </a>';

	mail($to, $subject, $message_body);

	header("Location: profile.php");
} 
else {

	$_SESSION['message'] = "Qeydiyyat alınmadı!";
	header("Location: error.php");
    
}




    
}
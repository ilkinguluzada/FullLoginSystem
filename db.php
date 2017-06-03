<?php
/* Databaza Elaqe */


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginsystem";


$conn =mysqli_connect($servername, $username, $password, $dbname);

// Əlaqəni yoxla
if (mysqli_connect_errno())
  {
  echo "Əlaqə Alınmadı: " . mysqli_connect_error();
  }

// Charseti utf8 et
mysqli_set_charset($conn,"utf8");


?>





<?php session_start();

if (isset($_SESSION['user'])) {
	header('location: content.php');
	die();
}else{
	header('location: signin.php');
}




 ?>
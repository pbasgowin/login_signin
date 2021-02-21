<?php session_start();
//1.- CHECK IF AN USER HAS A PREVIUS OPENED SESSION, IN THAT CASE, HEADER TO INDEX. 
	if (isset($_SESSION['user'])) {
		header('location: index.php');
		die();
	}
//2.- CREATE A VARIABLE $errors.
	$errors = '';
//3.- CHECK IF DATA WERE SENT BY POST.
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
//4.- USE VARIABLES TO RECEIVE DATA SENT BY THE FORM WHEN THE USER LOG IN.
//5.- VALIDATE DATA.
		$user = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
		$password = $_POST['password'];

//6.- CIPHER PASSWORD.
		$password = hash('sha512', $password);

//7.- PROVE AT THE SCREEN, IF DATA ARE RECEIVED AND CIPHER CORRECTLY.
	//echo $user .'- ' . $password;

//8.- CONNECT TO DB TO COMPARE IF DATA ARE IQUALS OR NOT.
		try{
			$conn = new PDO('mysql:host=localhost;dbname=login', 'root', '');
		}catch(PDOException $e){
			echo 'ERROR: ' . $e->getmessage();
			die();
		}
//9.- PREPARE SQL.
	$stm = $conn->prepare('SELECT * FROM users WHERE user = :user AND pass = :password');

	$stm->execute(array(':user' => $user, ':password' => $password));

	$result = $stm->fetch();

	//10.- PROVE WITH var_dump($result) TO SEE DATA.
	//var_dump($result);
	//11.- COMPARE THE VARIABLE, THEN IF DATA IS CORRECT, 
	//ASIGN A SESSION TO THAR USER($_SESSION['user'] = $user;) AND HEADER TO INDEX.
	if ($result !== false) {
		$_SESSION['user'] = $user;
		header('location: index.php');
	}else{
		$errors .= '<li>The user does not exist or fill data correctly.</li>';
		}

}

require 'views/login.view.php'; 
?>
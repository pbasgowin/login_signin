<?php session_start();//1ST: CREATE or INITIATE A SESSION WITH session_start()

//2ND: VERIFY IF THAT USER HAS ALREADY AN OPEN SESSION, IN THAT CASE, SEND TO INDEX OR CONTENT, IN ORDER TO AVOID ANOTHER USER REGISTRATION.
if (isset($_SESSION['user'])) {
	header('location: index.php');
	die();
}  
//3RD: CHECK IF DATA HAVE BEEN SENT BY POST AND THEN RECEIVED THEM.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//4TH: VALIDATE DATA REFILLED.
	$user = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	//echo $user . $password . $password2;

//4TH: CHECK IF FORMS ARE NOT EMPTIES. WHEN VARIABLE $errors IS NOT EMPTY, THERE ARE ERRORS.
	$errors = '';

	if ((empty($user) || empty($password)) || empty($password2)) {
		$errors .= '<li>Fill out all fields correctly</li>';
	}else{
//5TH: CHECK IF USER EXISTS: LET"S CONNECT TO DB.
		try{
			 $connection = new PDO('mysql:host=localhost;dbname=login', 'root', '');
		}catch(PDOException $e){
			echo 'ERROR: ' . $e->getmessage();
			die();
		}
//6TH: PREPARE A QUERY TO DB		
		$stm = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');

//7TH: EXECUTE 
		$stm->execute(array(':user' => $user));

//8TH: THE FETCH METHOD BRING THE VALUE, IF DOESN'T EXIST, IT'LL BE FALSE, THEN STORE THE VALUE IN A VARIABLE
		$result = $stm->fetch();

		//var_dump($result);

//9TH: 	IF THE RESULT IS DIFFERENT THAN FALSE, IT MEANS THAT THE USER EXISTS.
		if ($result != false) {
			$errors .= "<li>The user's name already exists.</li>";
		}

//10TH: CIPHER PASSWORDS.
		$password = hash('sha512', $password);
		$password2 = hash('sha512', $password2);

		//echo $user . $password . $password2;

//11TH: COMPARE IF PASSWORDS ARE IQUALS.
		if ($password != $password2) {
			$errors .= '<li>Passwords are differents.</li>';
		}
	}

//12TH: CHECK MISTAKES AND IF THERE'S ANY, PREPARE SQL TO INSERT DATA.
		if ($errors == '') {
			
			$stm = $connection->prepare('INSERT INTO users(id, user, pass) VALUES (null, :user, :pass)');

//13TH: EXECUTE
			$stm->execute(array(':user' => $user, 'pass' => $password));

			// echo 'Hola Mundo';

//14TH: AFTER MAKE REGISTER, ADDRESS TO login.php
			header('Location: login.php');
	}

}
require 'views/signin.view.php';
?>

 

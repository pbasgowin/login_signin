<?php session_start();

session_destroy();
//AN EMPTY ARRAY HELPS TO CLEAN THE SESSION AND INITIALIZE IT(SESSION WHITHOUT BRAKETS).
$_SESSION = array();

header('Location: login.php');
die();

?>
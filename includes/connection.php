<?php

session_start();
/* Setups up a connection the database */

$dbhost = "host";
$dbuser = "user";
$dbpassword = "password";
$dbname = "dbname";

try{
	$conn = new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
//show error
	echo '<p>'.$e->getMessage().'</p>';
	exit;
}


/* Include login functionality */
include("user.php");

$user = new User($conn);
?>

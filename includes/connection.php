<?php

session_start();
/* Setups up a connection the database */

$dbhost = "localhost"; //db.cs.dal.ca
$dbuser = "csci3172"; //AThoughtProject
$dbpassword = "password"; //B00atp3172
$dbname = "csci3172"; //AThoughtProject3172

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

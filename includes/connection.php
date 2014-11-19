<?php
/* Setups up a connection the database */

$dbhost = "db.cs.dal.ca";
$dbuser = "AThoughtProject";
$dbpassword = "B00atp3172";
$dbname = "AThoughtProject3172";

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

?>

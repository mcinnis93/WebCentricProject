<?php

require("includes/connection.php");

$user->logout();

if(isset($_GET['page']))
	//probably vulnerable to XSS, oh wells
	$page = $_GET['page'];
else
	$page = 'index.php';
header('Location: '.$page);
?>

<?php 

session_start();

require_once './config/config.php';

// echo $_SESSION['userId'];

if(!$_SESSION['role']) {
	header('location:'.$store_url);	
} 



?>
<?php 
session_start();
require_once './config/config.php';
unset($_SESSION["role"]);
session_destroy();
header('location:'.$store_url);
?>
<?php 
session_start();
$_SESSION['ymd']=$_GET['ymd'];
header("Location: main.php");
?>
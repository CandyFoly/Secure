<?php
//include('../class/autoloader.class.php');
$adresse = $_SERVER['PHP_SELF'];
$a = explode('/', $adresse);
$i = sizeof($a);
if($a[$i-1] == 'index.php'){
	require("class/autoloader.class.php");
}else{
	require("../class/autoloader.class.php");
}
Autoloader::register();
session_start();
?>
<!Doctype>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Accueil</title>
</head>
<body>
	<header></header>
	<div id="corps">
	<?php include('menu_view.php');?>

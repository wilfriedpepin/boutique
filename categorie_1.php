<!DOCTYPE html>
<html>
<head>
	<title>Listing</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="categorie.css">
</head>
<body>
	<?php 
		require_once('header.php');
		// ici on delare la connexion a la bdd
		$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	?>


 
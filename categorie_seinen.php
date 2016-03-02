<?php 
	session_start();
	require_once('categorie_1.php');
	$liste = $bdd->query("SELECT * FROM articles WHERE categorie = 'seinen' OR sous_categorie = 'seinen' ORDER BY nom,tome");
	require_once('categorie_2.php');
?>
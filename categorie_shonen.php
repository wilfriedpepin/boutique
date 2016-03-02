<?php 
	session_start();
	require_once('categorie_1.php');
	$liste = $bdd->query("SELECT * FROM articles WHERE categorie = 'shonen' OR sous_categorie = 'shonen' ORDER BY nom,tome");
	require_once('categorie_2.php');
		
 ?>
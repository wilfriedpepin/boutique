<?php 
	session_start();
	if (!empty( $_GET['recherche'])){
	$recherche = htmlspecialchars($_GET['recherche']);
	require_once('categorie_1.php');
	$liste = $bdd->query("SELECT  * FROM articles WHERE description  LIKE '%".$recherche."%' OR nom LIKE '%".$recherche."%' ORDER BY nom,tome");
	require_once('categorie_2.php');
}
	

 ?>

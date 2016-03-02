<?php 
	
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	if (!empty($_GET['id_supp']) && $_GET['action'] == 'supprimerArticle'){
	$supp_id = htmlspecialchars($_GET['id_supp']);
	$suppression = $bdd->prepare('DELETE FROM articles WHERE id = "'.$supp_id.'"');
	$suppression->execute();
	if ($suppression == true){
		header('Location: vue_article.php');
	}else{
		echo "Ce n'est pas possible";
	}
	}
 ?>

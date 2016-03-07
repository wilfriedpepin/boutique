<?php 
	session_start();
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	if(!empty($_GET['requete']) && $_GET['requete'] == 'order_id'){
		// ici c'est ci l'ont souhaite remettre les id en ordre
		$requete = $bdd->prepare('SELECT * FROM articles ORDER BY id');
		$requete->execute();
		$compteur = 1;
		while($requete_list = $requete->fetch()){
			$changement = $bdd->query('UPDATE articles SET id = "'.$compteur.'" WHERE id = "'.$requete_list['id'].'"');
			$compteur++;
		}
		header('Location: vue_article.php');
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Utilisateur</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../bootstrap.css">
	<link rel="stylesheet" href="css/header.css">

</head>
<body>
	<?php require_once('header.php'); ?>
 	<a href="ajout_article.php">Ajouter des articles</a></br>
 	<a href="vue_article.php?requete=order_id">Remettre ID a 0</a>
 	<table class="table table-bordered">
 		<tr>
 			<th><a href="vue_article.php?choix=1">ID</a></th>
 			<th><a href="vue_article.php?choix=2">Image</a></th>
 			<th><a href="vue_article.php?choix=3">Titre</a></th>
 			<th><a href="vue_article.php?choix=4">Tome</a></th>
 			<th><a href="vue_article.php?choix=5">Description</a></th>
 			<th><a href="vue_article.php?choix=6">Référence</a></th>
 			<th><a href="vue_article.php?choix=7">Prix</a></th>
 			<th><a href="vue_article.php?choix=8">Catégorie</a></th>
 			<th><a href="vue_article.php?choix=9">Sous-Catégorie</a></th>
 			<th>Action</th>
 		</tr>
 		<?php 
 			if(!empty($_GET['choix'])){
 				$choix = htmlspecialchars($_GET['choix']);
 				switch($choix){
 					// ici c'est pour trier le tableau du pnel admin comme on le souhaite en fonction des doénnée dans la table users
 					case 1:
 						$articles = $bdd->prepare('SELECT * FROM articles ORDER BY id');
 						break;
 					case 2:
 						$articles = $bdd->prepare('SELECT * FROM articles ORDER BY image');
 						break;
 					case 3:
 						$articles = $bdd->prepare('SELECT * FROM articles ORDER BY nom');
 						break;
 					case 4:
 						$articles = $bdd->prepare('SELECT * FROM articles ORDER BY tome');
 						break;
 					case 5:
 						$articles = $bdd->prepare('SELECT * FROM articles ORDER BY description');
 						break;
 					case 6:
 						$articles = $bdd->prepare('SELECT * FROM articles ORDER BY reference');
 						break;
 					case 7:
 						$articles = $bdd->prepare('SELECT * FROM articles ORDER BY prix');
 						break;
 					case 8:
 						$articles = $bdd->prepare('SELECT * FROM articles ORDER BY categorie');
 						break;
 					case 9:
 						$articles = $bdd->prepare('SELECT * FROM articles ORDER BY sous_categorie');
 						break;
 					default:
 						echo '<script>alert(\'WESH SA MARSH PA\'); document.location.href="vue_article.php"</script>';
 						break;

 				}
 			}else{
 				$articles = $bdd->prepare('SELECT * FROM articles');
 			}
 			$articles->execute();
 			while($liste_articles = $articles->fetch()){
 				// ici on affiche les données sous forme de tableau
 				echo '<tr>';
 				echo '<td>'.$liste_articles['id'].'</td>';
 				echo '<td>'.$liste_articles['image'].'</td>';
 				echo '<td>'.$liste_articles['nom'].'</td>';
 				echo '<td>'.$liste_articles['tome'].'</td>';
 				echo '<td>'.$liste_articles['description'].'</td>';
 				echo '<td>'.$liste_articles['reference'].'</td>';
 				echo '<td>'.$liste_articles['prix'].'</td>';
 				echo '<td>'.$liste_articles['categorie'].'</td>';
 				if(!empty($liste_articles['sous_categorie'])){
 					echo '<td>'.$liste_articles['sous_categorie'].'</td>';
 				}else{
 					echo '<td><em>Aucune</em></td>';
 				}
 				echo '<td><a href="modification_article.php?idart='.$liste_articles['id'].'&action=modifierArticle">Modifier</a><br><a href="suppresion_article.php?id_supp='.$liste_articles['id'].'&action=supprimerArticle">Supprimer</a>'.'</td>';
 				echo '</tr>';
 			}
 		 ?>
		</table>
		
</body>
</html>
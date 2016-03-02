<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Article</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="categorie.css">
	<link rel="stylesheet" href="bootstrap.css">
</head>
<body>
	<?php 
	require_once('header.php');
	if(!empty($_GET['ref'])){
		$reference_article = htmlspecialchars($_GET['ref']);
		$liste_ref_article = $bdd->query('SELECT * FROM articles WHERE id ="'.$reference_article.'"');
		$listing_ref_article = $liste_ref_article->fetch();
		echo '<div class="article">';
		echo '<img src="'.$listing_ref_article['image'].'" alt="image" class="image"><br>';
		echo 'TITRE: '.$listing_ref_article['nom'].'<br>';
		echo 'TOME: '.$listing_ref_article['tome'].'<br>';
		echo 'Description: '.$listing_ref_article['description'].'<br>';
		echo 'Reférence: '.$listing_ref_article['reference'].'<br>';
		echo 'prix: '.$listing_ref_article['prix'].'€<br>';
		echo 'categorie: '.$listing_ref_article['categorie'].'<br>';
		if (!empty($listing_ref_article['sous_categorie'])){
			echo '2ème categorie: '.$listing_ref_article['sous_categorie'].'<br>';
		}
		echo '<div>';
		if(!empty($_SESSION['pseudo']) && !empty($_SESSION['mdp'])){

			echo '<form method="post">';
			echo '<label for="qtt">Quantités:</label>';
			echo '<select name="qtt" id="qtt">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			</select>
			<input type="submit" value="Ajouter au panier">';
			echo '</form>';
			if(!empty($_POST['qtt'])){
				$qtt = htmlspecialchars($_POST['qtt']);
				header('Location: panier.php?id='.$listing_ref_article['id'].'&nom='.$listing_ref_article['nom'].'&tome='.$listing_ref_article['tome'].'&qtt='.$qtt);
			}
		}
	}else{
		echo "probleme";
	}
	?>
	<div>
		<h2>COMMENTAIRE</h2>
		<?php 
			if(!empty($_SESSION['pseudo']) && !empty($_SESSION['mdp'])){
				echo '<form method="post">
					<fieldset>
						<div class="form-group">
							<h3><label for="commentaire">Ajouter Un Commentaire</label></h3>
						<textarea name="commentaire" id="commentaire" cols="30" rows="10" placeholder="Votre commentaire ici..." class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label for="mark">Note de l\'article</label>
							<select name="mark" id="mark">
								<option value="0.5">0.5</option>
								<option value="1">1</option>
								<option value="1.5">1.5</option>
								<option value="2">2</option>
								<option value="2.5">2.5</option>
								<option value="3">3</option>
								<option value="3.5">3.5</option>
								<option value="4">4</option>
								<option value="4.5">4.5</option>
								<option value="5">5</option>
							</select>
						</div>
						<div>
							<input type="submit">
						</div>
					</fieldset>
				</form>';
			}
		?>
		
	</div>
	<div>
		<h3>Liste Des Commentaires</h3>
		<?php 
			$liste_commentaire = $bdd->prepare('SELECT * FROM commentaire WHERE id_article ="'.$listing_ref_article['id'].'" ORDER BY date DESC');
			$liste_commentaire->execute();
			while($listing_commentaire = $liste_commentaire->fetch()){
				echo 'Posté par '.$listing_commentaire['pseudo'].' le '.$listing_commentaire['date'].'<br>';
				echo 'NOTE: '.$listing_commentaire['note'].'<br>';
				echo 'Commentaire<br>'.$listing_commentaire['commentaire'].'<br>';
			}
		 ?>
	</div>
</body>
</html>
<?php  
if(!empty($_POST['commentaire']) && !empty($_POST['mark'])){
	$id_article = $listing_ref_article['id'];
	$mark_article = htmlspecialchars($_POST['mark']);
	$commentaire_article = htmlspecialchars($_POST['commentaire']);
	$pseudo = $_SESSION['pseudo'];
	$commentaire = $bdd->prepare("INSERT INTO commentaire VALUES ('',:id_article,:note,:commentaire,:pseudo,NOW())");
	$commentaire->execute(array(
		'id_article' => $id_article,
		'note' => $mark_article,
		'commentaire' => $commentaire_article,
		'pseudo' => $pseudo
		));
	echo '<script language="Javascript">
	document.location.replace("vue_article.php?ref='.$listing_ref_article['id'].'");
	</script>';
}
?>
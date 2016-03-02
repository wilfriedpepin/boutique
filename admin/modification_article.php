<?php 
	session_start();
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	require_once('fonction_admin.php');
	if (!empty($_GET['idart']) && $_GET['action'] == "modifierArticle"){
		$id = htmlspecialchars($_GET['idart']);
	}
	if(!empty($_POST['id'])){
		if (!empty($_POST['titre'])){
			$nom = htmlspecialchars($_POST['titre']);
			$modification = $bdd->prepare('UPDATE articles SET nom = "'.$nom.'" WHERE id = "'.$id.'"');
			$modification->execute();
		}
		
		if (!empty($_POST['tome'])){
			$tome = htmlspecialchars($_POST['tome']);
			$modification = $bdd->prepare('UPDATE articles SET tome = "'.$tome.'" WHERE id = "'.$id.'"');
			$modification->execute();
		}
		if (!empty($_POST['image'])){
			$image = htmlspecialchars($_POST['image']);
			$modification = $bdd->prepare('UPDATE articles SET image = "'.$image.'" WHERE id = "'.$id.'"');
			$modification->execute();
		}
		if(!empty($_POST['description'])){
			$description = htmlspecialchars($_POST['description']);
			$modification = $bdd->prepare('UPDATE articles SET description = "'.$description.'" WHERE id = "'.$id.'"');
			$modification->execute();
		}
		
		if(!empty($_POST['reference'])){
			$reference = htmlspecialchars($_POST['reference']);
			$modification = $bdd->prepare('UPDATE articles SET reference = "'.$reference.'" WHERE id = "'.$id.'"');
			$modification->execute();
		}
		if(!empty($_POST['prix'])){
			$prix = htmlspecialchars($_POST['prix']);
			$modification = $bdd->prepare('UPDATE articles SET prix = "'.$prix.'" WHERE id = "'.$id.'"');
			$modification->execute();
		}
		if(!empty($_POST['categorie'])){
			$categorie = htmlspecialchars($_POST['categorie']);
			$modification = $bdd->prepare('UPDATE articles SET categorie = "'.$categorie.'" WHERE id = "'.$id.'"');
			$modification->execute();
		}
		if(!empty($_POST['sous_categorie'])){
			$sous_categorie = htmlspecialchars($_POST['sous_categorie']);
			$modification = $bdd->prepare('UPDATE articles SET sous_categorie = "'.$sous_categorie.'" WHERE id = "'.$id.'"');
			$modification->execute();
		}else{
			$sous_categorie = htmlspecialchars($_POST['sous_categorie']);
			$modification = $bdd->prepare('UPDATE articles SET sous_categorie = NULL WHERE id = "'.$id.'"');
			$modification->execute();
		}
		header('Location: vue_article.php');		
	}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier un article</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../bootstrap.css">
	<link rel="stylesheet" href="css/header.css">
</head>
<body>
	<?php require_once('header.php'); ?>
	<main class="col-md-11 ">
				<h1>MODIFICATION D'UN ARTICLE</h1>
				<form method="post">
					<fieldset>
						<?php echo '<input type="hidden" id="id" name="id" class="form-control" value="'.$id.'"/>'; ?>
						<div>
							<label for="titre">Titre</label>
							<input type="text" id="titre" name="titre" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="tome">Tome</label>
							<input type="text" id="tome" name="tome" class="form-control"/> 
						</div>
						<div class="form-group">
							<label for="image">URI de l'Image</label>
							<input type="text" id="image" name="image" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label for="reference">Reference</label>
							<input type="text" id="reference" name="reference" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="prix">Prix</label>
							<input type="text" id="prix" name="prix" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="categorie">Catégorie</label>
							<select name="categorie" id="categorie" class="form-control">
								<option value="shonen" <?php $a = cat('shonen',$id); if($a == true){echo 'selected';}?>>Shonen</option>
								<option value="shoujo" <?php $a = cat('shoujo',$id); if($a == true){echo 'selected';}?>>Shoujo</option>
								<option value="seinen" <?php $a = cat('seinen',$id); if($a == true){echo 'selected';}?>>Seinen</option>
							</select>
						</div>
						<div class="form-group">
							<label for="sous_categorie">2nd Catégorie</label>
							<select name="sous_categorie" id="sous_categorie" class="form-control">
								<option value="shonen" <?php $b = sCat('shonen',$id); if($b == true){echo 'selected';}?>>Shonen</option>
								<option value="shoujo" <?php $b = sCat('shoujo',$id); if($b == true){echo 'selected';}?>>Shoujo</option>
								<option value="seinen" <?php $b = sCat('seinen',$id); if($b == true){echo 'selected';}?>>Seinen</option>
								<option value="" <?php $b = sCat('',$id); if($b == true){echo 'selected';}?>>Aucun</option>
							</select>
						</div>
						<input type="submit">
					</fieldset>
				</form>
			</main>
</body>
</html>
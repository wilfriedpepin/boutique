<?php 
SESSION_START();
$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
require_once('fonction_admin.php');
if ((!empty($_POST['titre2']) || !empty($_POST['titre'])) &&!empty($_POST['tome'])&&!empty($_POST['image'])&&!empty($_POST['description'])&&!empty($_POST['reference'])&&!empty($_POST['prix'])&&!empty($_POST['categorie']))
{
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	if(!empty($_POST['titre'])){
		$nom = htmlspecialchars($_POST['titre']);
	}else{
		$nom = htmlspecialchars($_POST['titre2']);
	}
	$tome = htmlspecialchars($_POST['tome']);
	$image = htmlspecialchars($_POST['image']);
	$description = htmlspecialchars($_POST['description']);
	$reference = htmlspecialchars($_POST['reference']);
	$prix = htmlspecialchars($_POST['prix']);
	$categorie = htmlspecialchars($_POST['categorie']);
	$sous_categorie = htmlspecialchars($_POST['sous_categorie']);
	$insertion = $bdd->prepare("INSERT INTO articles(id,image,nom,tome,description,reference,prix,categorie,sous_categorie) VALUES ('',:image,:nom,:tome,:description,:reference,:prix,:categorie,:sous_categorie)");
	$insertion ->execute(array(
		'image'=>$image,
		'nom'=>$nom,
		'tome'=>$tome,
		'description'=>$description,
		'reference'=>$reference,
		'prix'=>$prix,
		'categorie'=>$categorie,
		'sous_categorie'=>$sous_categorie
	));
	if($insertion)
	{

		$check = checkTitle($_SESSION['titreArticle'], $nom);
		if($check == false){
			array_push($_SESSION['titreArticle'], $nom);
		}
		
		header('Location: ../index.php');
	}
		
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Ajout d'un article</title>
 	<meta charset="utf-8">
 	<link rel="stylesheet" href="../bootstrap.css">
 	<link rel="stylesheet" href="css/header.css">
 </head>
 <body>
 <?php require_once('header.php'); ?>
 <div class="container">
		<div class="row body">
			<aside class="col-md-1 description">
				
			</aside>
			<main class="col-md-11 ">
				<h1>AJOUT D'UN ARTICLE</h1>
				<form method="post">
					<fieldset>
						<div class="form-group">
							<label for="titre">Titre</label>
							<input type="text" id="titre" name="titre" placeholder="Si le titre n'existe pas..." class="form-control"/>
						</div>
						<div class="form-group">
							<select name="titre2" id="titre2" class="form-control">
								<?php 
									echo '<option value="" selected>Aucun</option>';
									for ($i=0; $i < count($_SESSION['titreArticle']); $i++) { 
										echo '<option value="'.$_SESSION['titreArticle'][$i].'">'.$_SESSION['titreArticle'][$i].'</option>';
									}	
								?>
							</select>
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
								<option value="shonen">Shonen</option>
								<option value="shoujo">Shoujo</option>
								<option value="seinen">Seinen</option>
							</select>
						</div>
						<div class="form-group">
							<label for="sous_categorie">2nd Catégorie</label>
							<select name="sous_categorie" id="sous_categorie" class="form-control">
								<option value="shonen">Shonen</option>
								<option value="shoujo">Shoujo</option>
								<option value="seinen">Seinen</option>
								<option value="" selected>Aucun</option>
							</select>
						</div>
						<input type="submit">
					</fieldset>
				</form>
				
			</main>
		</div>
	</div>

 </body>
 </html>
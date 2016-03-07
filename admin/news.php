<?php 
session_start();
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
if(!empty($_POST['titre']) && !empty($_POST['description'])){
	/*Lorsque que le formzlaire pour faire une nouvelle news est ecrite je l'inserre dans la base de donnée avec la table news*/
	$titre = htmlspecialchars($_POST['titre']);
	$description = htmlspecialchars($_POST['description']);
	$insertion = $bdd->prepare("INSERT INTO news VALUES('',:titre,:description,:pseudo,NOW())");
	$insertion->execute(array(
		'titre'=>$titre,
		'description'=>$description,
		'pseudo'=>$_SESSION['pseudo']
		));
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajout news</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../bootstrap.css">
	<link rel="stylesheet" href="css/header.css">
</head>
<body>
	<?php require_once('header.php'); ?>
	<h1>Ajout d'une news</h1>
	<form method="post">
		<fieldset>
	 		<div class="form-group">
	 			<label for="titre">Titre</label>
	 			<input type="text" id="titre" name="titre" class="form-control">
	 		</div>
	 		<div class="form-group">
	 		<label for="description">Description</label>
		 		<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
	 		</div>
	 		<input type="submit">
	 	</fieldset>
	</form>
</body>
</html>
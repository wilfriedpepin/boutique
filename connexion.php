<?php 
SESSION_START();
if(!empty($_POST)){
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$password = htmlspecialchars($_POST['mdp']);
 	$query = $bdd->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
 	$reponse = $query->execute(array(
 		"pseudo"=>$pseudo
 	));
 	$users = $query->fetch();
 	if(!empty($users) && SHA1($password) == $users['mdp']){
 		$_SESSION['pseudo'] = $users['pseudo'];
 		$_SESSION['mdp'] = $users['mdp'];
 		$_SESSION['panier'] = array();
 		$_SESSION['panier']['id'] = array();
 		$_SESSION['panier']['nomDuProduit'] = array();
 		$_SESSION['panier']['tome'] = array();
 		$_SESSION['panier']['quantite'] = array();
 		$_SESSION['titreArticle'] = array();
 		$_SESSION['prixTotal'] = array();
 		$titre_article = $bdd->query("SELECT DISTINCT nom FROM articles");
 		while($liste_titre_article = $titre_article->fetch()){
 			array_push($_SESSION['titreArticle'], $liste_titre_article['nom']);
 		}
 		header('location:index.php');
 	}else{
 		echo '<script>alert("vous n\'existez pas");'.'</script><br>';
 	}
}


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap.css">
</head>
<body>
	<?php 
		require_once('header.php');
	 ?>
	 <main class="container">
	 	<div class="row">
	 		<div class="col-md-12">
	 			<h2>CONNEXION</h2>
	 			<form method="post">
				 	<fieldset>
				 		<div class="form-group">
				 			<label for="pseudo">Pseudo</label>
				 			<input type="text" id="pseudo" name="pseudo" class="form-control">
				 		</div>
				 		<div class="form-group">
					 		<label for="mdp">MotDePasse</label>
					 		<input type="password" id="mdp" name="mdp" class="form-control" >
				 		</div>
				 		<input type="submit">
				 	</fieldset>
				 </form>
				 <h4><a href="inscription.php">S'incrire</a></h4>
	 		</div>
	 	</div>
	 </main>
	 

</body>
</html>
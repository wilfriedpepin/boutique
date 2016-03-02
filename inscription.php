<?php 
	session_start();
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	if(!empty($_POST['pseudo'])){
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$test = $bdd->query('SELECT * FROM users WHERE pseudo ="'.$pseudo.'"');
		$liste_pseudo = $test->fetch();
		if(!empty($liste_pseudo)){
			echo '<script>alert(\'Ce pseudo existe déjà\')</script>';
		}else{
		if (!empty($_POST['nom'])&&!empty($_POST['prenom'])&&!empty($_POST['pseudo'])&&!empty($_POST['mdp_confirm'])&&!empty($_POST['mdp'])&&!empty($_POST['email'])&&!empty($_POST['numtel'])&&!empty($_POST['adresse']))
		{
			$nom = htmlspecialchars($_POST['nom']);
			$prenom = htmlspecialchars($_POST['prenom']);
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$mdp = SHA1(htmlspecialchars($_POST['mdp']));
			$mdp_confirm = SHA1(htmlspecialchars($_POST['mdp_confirm']));
			$email = htmlspecialchars($_POST['email']);
			$numtel = htmlspecialchars($_POST['numtel']);
			$adresse = htmlspecialchars($_POST['adresse']);
			if ($mdp == $mdp_confirm){
				$insertion = $bdd->prepare("INSERT INTO users(id,prenom,nom,pseudo,mdp,email,numtel,adresse) VALUES ('',:prenom,:nom,:pseudo,:mdp,:email,:numtel,:adresse)");
				$insertion ->execute(array(
					'prenom'=>$prenom,
					'nom'=>$nom,
					'pseudo'=>$pseudo,
					'mdp'=>$mdp,
					'email'=>$email,
					'numtel'=>$numtel,
					'adresse'=>$adresse
				));
				if($insertion)
				{
					echo '<script>alert(\'Vous avez réussi\');</script>';
				}
			}
			if ($mdp != $mdp_confirm){
				echo '<script>alert(\'Les mots de passe ne correspondent pas!\');</script>';
			}
			
		}else{ echo '<script>alert(\'il manque au moins un paramètre\')</script>';}
	}
}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap.css">
</head>
<body>
	<?php 
		require_once('header.php');
	 ?>
	<div class="container">
		<div class="row body">
			<aside class="col-md-1 description">
				<script>alert('Coucou ca va la famille'); if(confirm(windows.reload();</script>
			</aside>
			<main class="col-md-11 ">
				<h1>INSCRIPTION</h1>
				<form method="post">
					<fieldset>
						<div class="form-group">
							<label for="nom">Nom</label>
							<input type="text" id="nom" name="nom" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="prenom">Prénom</label>
							<input type="text" id="prenom" name="prenom" class="form-control"/> 
						</div>
						<div class="form-group">
							<label for="pseudo">Pseudo</label>
							<input type="text" id="pseudo" name="pseudo" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="mdp">MotDePasse</label>
							<input type="password" id="mdp" name="mdp" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="mdp_confirm">Confirmation</label>
							<input type="password" id="mdp_confirm" name="mdp_confirm" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="text" id="email" name="email" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="numtel">Numéro de Téléphone</label>
							<input type="text" id="numtel" name="numtel" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="adresse">Adresse Postal</label>
							<input type="text" id="adresse" name="adresse" class="form-control"/>
						</div>
						<input type="submit">
					</fieldset>
				</form>
				
			</main>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<footer class="col-md-12">
		
			</footer>
		</div>
	</div>
	
</body>
</html>
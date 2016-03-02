<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
if(!empty($_GET['pseudo'])){
	$pseudo = htmlspecialchars($_GET['pseudo']);
}else{ header('Location: profil.php');}

if(!empty($_POST['old_mdp']) && !empty($_POST['new_mdp']) && !empty($_POST['new_mdp_repeat'])){
	$oldMdp = htmlspecialchars($_POST['old_mdp']);
	$newMdp = htmlspecialchars($_POST['new_mdp']);
	$newMdpRepeat = htmlspecialchars($_POST['new_mdp_repeat']);
	$currentMdp = $bdd->query('SELECT mdp FROM users WHERE pseudo="'.$_SESSION['pseudo'].'"');
	$myCurrentMdp = $currentMdp->fetch();
	if(SHA1($oldMdp) == $myCurrentMdp['mdp']){
		if($newMdp == $newMdpRepeat){
			$modMdp = $bdd->prepare('UPDATE users SET mdp = "'.SHA1($newMdp).'" WHERE pseudo="'.$_SESSION['pseudo'].'"');
			$modMdp->execute();
			header('Location: profil.php');
		}else{ echo "<script>alert('Les deux mots de passe ne correspondent pas')</script>";}
	}else{
		echo "<script>alert('Votre mot de passe actuel est erronée')</script>";
	}
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Modification</title>
 	<meta charset="utf-8">
 	<link rel="stylesheet" href="bootstrap.css">
 </head>
 <body>
 	<?php require_once('header.php'); ?>
 	<main class="col-md-11">
 		<form method="post">
	 		<fieldset>
	 			<?php echo '<input type="hidden" id="pseudo" name="pseudo" value="'.$pseudo.'">' ?>
	 			<div class="form-group">
	 				<label for="old_mdp">Votre ancien mot de passe</label>
	 				<input type="password" id="old_mdp" name="old_mdp" class="form-control">
	 			</div>
	 			<div class="form-group">
	 				<label for="new_mdp">Votre nouveau mot de passe</label>
	 				<input type="password" id="new_mdp" name="new_mdp" class="form-control">
	 			</div>
	 			<div class="form-group">
	 				<label for="new_mdp_repeat">Repeter le mot de passe</label>
	 				<input type="password" id="new_mdp_repeat" name="new_mdp_repeat" class="form-control">
	 			</div>
	 			<input type="submit" value="changement">
	 		</fieldset>
	 	</form>
 	</main>
 	
 </body>
 </html>
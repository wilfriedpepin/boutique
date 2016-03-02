<?php 
SESSION_START();
require_once('fonction_commande.php');
$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Commande</title>
 	<meta charset="utf-8">
 	<link rel="stylesheet" href="bootstrap.css">
 	<link rel="stylesheet" href="categorie.css">
 </head>
 <body>
 	<?php 
 		require_once('header.php');
 		$id_users = searchUsers();
 		$numero = nextNumero();
 		$prix = $_SESSION['prixTotal'][0];
 		$description = stockDescription();
		$commande = $bdd->prepare("INSERT INTO commande VALUES ('',:id_users,:numero,:prix,:description,NOW())");
		$commande->execute(array(
			'id_users'=>$id_users,
			'numero'=>$numero,
			'prix'=>$prix,
			'description'=>$description
		));
		emptyPanier();
		header('Location: profil.php');
 	?>
 </body>
 </html>
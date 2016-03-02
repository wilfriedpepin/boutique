<?php 
SESSION_START();
require_once('fonction_admin.php');
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Utilisateur</title>
 	<meta charset="utf-8">
 	<link rel="stylesheet" href="css/vue_utilisateur.css">
 	<link rel="stylesheet" href="css/header.css">
 	<link rel="stylesheet" href="../bootstrap.css">
 </head>
 <body>
 	<?php require_once('header.php'); ?>
 	<table class="table table-bordered">
 		<tr>
 			<th><a href="vue_utilisateur.php?choix=1">ID</a></th>
 			<th><a href="vue_utilisateur.php?choix=2">Prenom</a></th>
 			<th><a href="vue_utilisateur.php?choix=3">Nom</a></th>
 			<th><a href="vue_utilisateur.php?choix=4">Pseudo</a></th>
 			<th><a href="vue_utilisateur.php?choix=5">email</a></th>
 			<th><a href="vue_utilisateur.php?choix=6">Numero De Téléphone</a></th>
 			<th><a href="vue_utilisateur.php?choix=7">adresse</a></th>
 			<th>Action</th>
 		</tr>
 		<?php
 			if(!empty($_GET['choix'])){
 				$choix = htmlspecialchars($_GET['choix']);
 			}else{$choix = 0;}
 		 	viewUsers($choix);
 		 	if(!empty($_GET['id']) && $_GET['action'] == "modifier"){
 		 		$id = htmlspecialchars($_GET['id']);
 		 		modificationUsers($id);
 		 		
 		 	}
 		 	if(!empty($_GET['id']) && $_GET['action'] == "supprimer"){
 		 		$id = htmlspecialchars($_GET['id']);
 		 		deleteUsers($id);
 		 		header('Location: vue_utilisateur.php');
 		 	}
 		 ?>

 	</table>
 </body>
 </html>

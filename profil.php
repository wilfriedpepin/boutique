<?php 
SESSION_START();
$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Profil</title>
 	<meta charset="utf-8">
 	<link rel="stylesheet" href="bootstrap.css">
 </head>
 <body>
 	<?php require_once('header.php'); ?>
 	<h1>Mon Profil</h1>
 	<h2>Bienvenue sur votre profil: <?php echo $_SESSION['pseudo']; ?></h2>
 	<?php echo '<a href="modification_profil.php?pseudo='.$_SESSION['pseudo'].'">Modifier le mot de passe</a>'; ?>
 	<table class="table table-borderer">
 		<h2>Commande</h2>
 		<tr>
 			<th>N° de commande</th>
 			<th>Liste des produits</th>
 			<th>Prix</th>
 			<th>Date d'achat</th>
 		</tr>
 		<?php 
 			$id = $bdd->query('SELECT id FROM users WHERE pseudo="'.$_SESSION['pseudo'].'"');
 			$this_id = $id->fetch();
			$list_commande = $bdd->query('SELECT * FROM commande WHERE id_users="'.$this_id[0].'"');
			while($listing_commande = $list_commande->fetch()){
				echo '<tr>';
				echo '<td>'.$listing_commande['numero'].'</td>';
				echo '<td>'.$listing_commande['description'].'</td>';
				echo '<td>'.$listing_commande['prix'].'</td>';
				echo '<td>'.$listing_commande['datenow'].'</td>';
				echo '</tr>';
			}
 		?>
 	</table>
 	
 </body>
 </html>
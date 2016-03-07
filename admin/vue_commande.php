<?php 
	session_start();
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	if(!empty($_GET['requete']) && $_GET['requete'] == 'order_id'){
		// pour permettre de trier les id
		$requete = $bdd->prepare('SELECT * FROM commande ORDER BY id');
		$requete->execute();
		$compteur = 1;
		while($requete_list = $requete->fetch()){
			$changement = $bdd->query('UPDATE commande SET id = "'.$compteur.'" WHERE id = "'.$requete_list['id'].'"');
			$compteur++;
		}
		header('Location: vue_commande.php');
	}
	if(!empty($_GET['requete'])&& !empty($_GET['id']) && $_GET['requete'] == 'cancel'){
		$id = htmlspecialchars($_GET['id']);
		$cancel = $bdd->query('DELETE FROM commande WHERE id="'.$id.'"');
		header('Location: vue_commande.php');
	}
?>
 <!DOCTYPE html>
<html>
<head>
	<title>Commande</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../bootstrap.css">
	<link rel="stylesheet" href="css/header.css">

</head>
<body>
	<?php 
		require_once('header.php'); 
	?>
	<a href="vue_commande.php?requete=order_id">Remettre ID a 0</a>
 	<table class="table table-bordered">
 		<tr>
 			<th><a href="vue_commande.php?choix=1">ID</a></th>
 			<th><a href="vue_commande.php?choix=2">Pseudo</a></th>
 			<th><a href="vue_commande.php?choix=3">numero</a></th>
 			<th><a href="vue_commande.php?choix=4">Date</a></th>
 			<th><a href="vue_commande.php?choix=5">Commande</a></th>
 			<th><a href="vue_commande.php?choix=6">Prix</a></th>
 			<th>Action</th>
 		</tr>
 		<?php 
 			if(!empty($_GET['choix'])){
 				$choix = htmlspecialchars($_GET['choix']);
 				switch($choix){
 					case 1:
 						$commande = $bdd->prepare('SELECT * FROM commande ORDER BY id');
 						break;
 					case 2:
 						$commande = $bdd->prepare('SELECT * FROM commande ORDER BY id_users');
 						break;
 					case 3:
 						$commande = $bdd->prepare('SELECT * FROM commande ORDER BY numero');
 						break;
 					case 4:
 						$commande = $bdd->prepare('SELECT * FROM commande ORDER BY datenow');
 						break;
 					case 5:
 						$commande = $bdd->prepare('SELECT * FROM commande ORDER BY description');
 						break;
 					case 6:
 						$commande = $bdd->prepare('SELECT * FROM commande ORDER BY prix');
 						break;
 					default:
 						echo '<script>alert(\'WESH SA MARSH PA\'); document.location.href="vue_commande.php"</script>';
 						break;

 				}
 			}else{
 				$commande = $bdd->prepare('SELECT * FROM commande');
 			}
 			$commande->execute();
 			
 			while($liste_commande = $commande->fetch()){
 				$pseudo = $bdd->query('SELECT * FROM users WHERE id ="'.$liste_commande['id_users'].'"');
 				//Ici on afficle les commandes sous forme de tableau
 				$thePseudo = $pseudo->fetch();
 				echo '<tr>';
 				echo '<td>'.$liste_commande['id'].'</td>';
 				echo '<td>'.$thePseudo['pseudo'].'</td>';
 				echo '<td>'.$liste_commande['numero'].'</td>';
 				echo '<td>'.$liste_commande['datenow'].'</td>';
 				echo '<td>'.$liste_commande['description'].'</td>';
 				echo '<td>'.$liste_commande['prix'].'</td>';
 				echo '<td><a href="vue_commande.php?requete=cancel&id='.$liste_commande['id'].'">Annuler</a></td>';
 				echo '</tr>';
 			}
 		 ?>
		</table>
</body>
</html>
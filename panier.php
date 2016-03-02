 <?php  
 	SESSION_START(); 
 	require_once('fonction_panier.php'); 
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Panier</title>
 	<meta charset="utf-8">
 	<link rel="stylesheet" href="bootstrap.css">
 	<link rel="stylesheet" href="categorie.css">
 </head>
 <body>
 	<?php 

	 	require_once('header.php'); 
	 	if(!empty($_POST['commande'])){
	 		header('Location: commande.php');
	 	}
		if(!empty($_GET['id']) && !empty($_GET['nom']) && !empty($_GET['tome']) &&!empty($_GET['qtt']) && !empty($_SESSION['pseudo'])){
			$id = htmlspecialchars($_GET['id']);
			$nom = htmlspecialchars($_GET['nom']);
			$tome = htmlspecialchars($_GET['tome']);
			$qtt = htmlspecialchars($_GET['qtt']);
			ajoutArticle($id,$nom,$tome,$qtt);
		}
		if (!empty($_GET['sup']) && $_GET['sup'] == "suppression" && !empty($_GET['id'])){
			$id = htmlspecialchars($_GET['id']);
			deleteArticle($id);
			header('Location: panier.php');
		}
		if(!empty($_GET['mod']) && $_GET['mod'] == "modifier" && !empty($_GET['id'])){
			$id = htmlspecialchars($_GET['id']);
			modifierArticle($id,$qtt);
			header('Location: panier.php');
		}
		viewPanier($_SESSION['panier']);
	?>
	<script type="text/javascript">
		var prix = '<?php echo $prix_total; ?>';
		alert(prix);
		document.getElementById('command_button').disabled = true;
	</script>
 </body>
 </html>
 
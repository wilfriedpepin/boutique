<?php 
function searchPanier($titre,$tome){
	$i = 0;
	while ($i < count($_SESSION['panier']['id'])) {
		if($_SESSION['panier']['nomDuProduit'][$i] == $titre){
			$j = $i;
			if($_SESSION['panier']['tome'][$j] == $tome){
				return true;
			}
			$i++;
		}else{
			$i++;
		}
	}
	return false;
}
function calculPrix($panier){
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	$prix_total = 0;
	$prix = $bdd->prepare('SELECT prix FROM articles WHERE id = :id');
	for ($i=0; $i < count($panier['quantite']); $i++) { 
		$prix->execute(array(
			'id' => $panier['id'][$i]
		));
		$liste_prix = $prix->fetch();
		$prix_article = (float) $panier['quantite'][$i] * (float) $liste_prix[0];
		$prix_total += $prix_article;
	}
	$_SESSION['prixTotal'][0] = $prix_total;
	return $prix_total;
}
function modifierArticle($id,$qtt){
	for ($i=0; $i < count($_SESSION['panier']['id']); $i++) { 
		if($_SESSION['panier']['id'][$i] == $id){
			$_SESSION['panier']['quantite'][$i] == $qtt;
		}
	}
}
function ajoutArticle($id,$nom,$tome,$qtt){
		$resultat = searchPanier($nom,$tome);
		if($resultat == false){
			array_push($_SESSION['panier']['id'], $id);
			array_push($_SESSION['panier']['nomDuProduit'], $nom);
			array_push($_SESSION['panier']['tome'], $tome);
			array_push($_SESSION['panier']['quantite'], $qtt);
		}
		
}
function viewPanier($panier){
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	$prix_total = calculPrix($panier); 
	$liste_panier = $bdd->prepare('SELECT * FROM articles WHERE id = :id');
	echo '<h1>Mon Panier:</h1>'.PHP_EOL;
	echo '<h2>Prix Total: '.$prix_total.'</h2>';
	echo '<form method="post" ><button type="submit" value="commande" name="commande" id="command_button">Acheter</button>';
	echo '<div class="container-fluid">';
		echo '<div class="row ">';
			for ($i=0; $i < count($panier['id']);$i++){ 
				$liste_panier->execute(array(
						'id' => $panier['id'][$i]
					));
				$listing_panier = $liste_panier->fetch();
				$prix_this_article = (float) $listing_panier['prix'] * (float) $panier['quantite'][$i];
				echo '<div class="col-md-4 article col-sm-6 col-xs-12">';
					echo '<img class="img-responsive image" src="'.$listing_panier['image'].'" alt="lol">';
					echo 'TITRE: '.$listing_panier['nom'].'<br>';
					echo 'TOME: '.$listing_panier['tome'].'<br>';
					echo 'Description: '.$listing_panier['description'].'<br>';
					echo 'Reférence: '.$listing_panier['reference'].'<br>';
					echo 'prix: '.$listing_panier['prix'].'€<br>';
					echo 'categorie: '.$listing_panier['categorie'].'<br>';
					if (!empty($listing_panier['sous_categorie'])){
						echo '2ème categorie: '.$listing_panier['sous_categorie'].'<br>';
					}
					echo 'quantité: '.$panier['quantite'][$i].'<br>';
					echo 'Prix Total: '.$prix_this_article.'<br>';
					echo '<a href="panier.php?mod=modifier&id='.$listing_panier['id'].'">Modifier quantité article</a><br>';
					echo '<a href="panier.php?sup=suppression&id='.$listing_panier['id'].'">Supprimer l\'article du panier</a>';
				echo '</div>';
			
			}
		echo '</div>';
	echo '</div>';
	?>
	<script type="text/javascript">
		var prix = '<?php echo $prix_total; ?>';
		if(prix <= 0){
			document.getElementById('command_button').disabled = true;
		}else{
			document.getElementById('command_button').disabled = false;
		}
	</script>
	<?php
 }
 function deleteArticle($id){
 	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
 	for ($i=0; $i < count($_SESSION['panier']['id']); $i++) { 
 		if ($_SESSION['panier']['id'][$i] == $id){
 			unset($_SESSION['panier']['id'][$i]);
 			$_SESSION['panier']['id'] = array_merge($_SESSION['panier']['id']);
 			unset($_SESSION['panier']['nomDuProduit'][$i]);
 			$_SESSION['panier']['nomDuProduit'] = array_merge($_SESSION['panier']['nomDuProduit']);
 			unset($_SESSION['panier']['tome'][$i]);
 			$_SESSION['panier']['tome'] = array_merge($_SESSION['panier']['tome']);
 			unset($_SESSION['panier']['quantite'][$i]);
 			$_SESSION['panier']['quantite'] = array_merge($_SESSION['panier']['quantite']);
 		}
 	}
 }

?>
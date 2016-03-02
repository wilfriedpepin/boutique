<?php 
	function nextNumero(){
		$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
		$list_num = $bdd->query('SELECT numero FROM commande ORDER BY numero DESC LIMIT 1');
		$listing_num = $list_num->fetch();
		var_dump($listing_num);
		if(!empty($listing_num)){
			$numero = (int) $listing_num[0] + 1;
			return $numero;
		}else{
			$numero = 1000000;
			return $numero;
		}
	}

	function searchUsers(){
		$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
		$user = $bdd->query('SELECT id FROM users WHERE pseudo="'.$_SESSION['pseudo'].'"');
		$list_user = $user->fetch();
		if(!empty($list_user)){
			$id_users = $list_user[0];
			return $id_users;
		}
	}
	function stockDescription(){
		$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
		$description = '';
		for ($i=0; $i < count($_SESSION['panier']['id']); $i++) { 
			$nomDuProduit = $_SESSION['panier']['nomDuProduit'][$i];
			$quantite = $_SESSION['panier']['quantite'][$i];
			$list_prix = $bdd->query('SELECT prix FROM articles WHERE id="'.$_SESSION['panier']['id'][$i].'"');
			$listing_prix = $list_prix->fetch();
			$prix = (float) $listing_prix[0] * (float) $_SESSION['panier']['quantite'][$i];
			$this_description = ''.$quantite.'x'.$nomDuProduit.',prix total: '.$prix.PHP_EOL;
			$description .= $this_description;
		}
		return $description;
	}
	function emptyPanier(){
		$_SESSION['panier']['id'] = array();
 		$_SESSION['panier']['nomDuProduit'] = array();
 		$_SESSION['panier']['tome'] = array();
 		$_SESSION['panier']['quantite'] = array();
 		$_SESSION['titreArticle'] = array();
 		$_SESSION['prixTotal'] = array();
	}
 ?>
<?php 
function viewForm(){
	echo '
	<form method="post">
		<fieldset>
			<label for="id">ID</label>
			<input type="text" name="id" id="id">

			<label for="firstname">Prénom</label>
			<input type="text" id="firstname" name="firstname">

			<label for="lastname">Nom</label>
			<input type="text" id="lastname" name="lastname">

			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo">

			<label for="email">E-mail</label>
			<input type="text" id="email" name="email">

			<label for="numtel">Numtel</label>
			<input type="text" id="numtel" name="numtel">

			<label  for="adress">Adresse</label>
			<input type="text" id="adress" name="adress">

			<input type="submit" value="modifier">
		</fieldset>
	</form>';
}


function checkTitle($tableau,$titre){
	for ($i=0; $i < count($tableau); $i++) { 
		if($tableau[$i] == $titre){
			return true;
		}
	}
	return false;
}
function viewUsers($choix){
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	if($choix != 0){
		switch($choix){
 					case 1:
 						$list_users = $bdd->prepare('SELECT * FROM users ORDER BY id');
 						break;
 					case 2:
 						$list_users = $bdd->prepare('SELECT * FROM users ORDER BY prenom');
 						break;
 					case 3:
 						$list_users = $bdd->prepare('SELECT * FROM users ORDER BY nom');
 						break;
 					case 4:
 						$list_users = $bdd->prepare('SELECT * FROM users ORDER BY pseudo');
 						break;
 					case 5:
 						$list_users = $bdd->prepare('SELECT * FROM users ORDER BY email');
 						break;
 					case 6:
 						$list_users = $bdd->prepare('SELECT * FROM users ORDER BY numtel');
 						break;
 					case 7:
 						$list_users = $bdd->prepare('SELECT * FROM users ORDER BY adresse');
 						break;
 					default:
 						echo '<script>alert(\'WESH SA MARSH PA\'); document.location.href="vue_article.php"</script>';
 						break;
 		}
	}else{
		$list_users = $bdd->prepare('SELECT * FROM users ORDER BY id');
	}
	
	$list_users->execute();
	while($listing_users = $list_users->fetch()){
		echo '<tr>';
		echo '<td>'.$listing_users['id'].'</td>';
		echo '<td>'.$listing_users['prenom'].'</td>';
		echo '<td>'.$listing_users['nom'].'</td>';
		echo '<td>'.$listing_users['pseudo'].'</td>';
		echo '<td>'.$listing_users['email'].'</td>';
		echo '<td>'.$listing_users['numtel'].'</td>';
		echo '<td>'.$listing_users['adresse'].'</td>';
		echo '<td><a href="vue_utilisateur.php?id='.$listing_users['id'].'&action=modifier">Modifier</a>'.' '.'<a href="vue_utilisateur.php?id='.$listing_users['id'].'&action=supprimer">Supprimer</a>'.'</td>';
		echo '</tr>';
	}
}

function deleteUsers($id){
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	$supp_users = $bdd->prepare('DELETE FROM users WHERE id = '.$id);
	$supp_users->execute();
 }

 function modificationUsers($id){
 	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
 	$modification = false;
 	viewForm();
 	if(!empty($_POST['id'])){
 		$id_users = htmlspecialchars($_POST['id']);
 		$modification = $bdd->prepare('UPDATE users SET id = "'.$id_users.'" WHERE id ="'.$id.'"');
		$modification->execute();
 	}
 	if(!empty($_POST['lastname'])){
		$nom = htmlspecialchars($_POST['lastname']);
		$modification = $bdd->prepare('UPDATE users SET nom = "'.$nom.'" WHERE id ="'.$id.'"');
		$modification->execute();
	}
	if(!empty($_POST['firstname'])){
		$prenom = htmlspecialchars($_POST['firstname']);
		$modification = $bdd->prepare('UPDATE users SET prenom = "'.$prenom.'" WHERE id ="'.$id.'"');
		$modification->execute();
	}
	if(!empty($_POST['pseudo'])){
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$modification = $bdd->prepare('UPDATE users SET pseudo = "'.$pseudo.'" WHERE id ="'.$id.'"');
		$modification->execute();
	}
	if(!empty($_POST['email'])){
		$email = htmlspecialchars($_POST['email']);
		$modification = $bdd->prepare('UPDATE users SET email = "'.$email.'" WHERE id ="'.$id.'"');
		$modification->execute();
	}
	if(!empty($_POST['numtel'])){
		$numtel = htmlspecialchars($_POST['numtel']);
		$modification = $bdd->prepare('UPDATE users SET numtel = "'.$numtel.'" WHERE id ="'.$id.'"');
		$modification->execute();
	}
	if(!empty($_POST['adress'])){
		$adresse = htmlspecialchars($_POST['adress']);
		$modification = $bdd->prepare('UPDATE users SET adresse = "'.$adresse.'" WHERE id ="'.$id.'"');
		$modification->execute();
	}
	if($modification == true){
		header('Location: vue_utilisateur.php');
	}
 }
function cat($option,$id){
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	$select = $bdd->query('SELECT * FROM articles WHERE id="'.$id.'"');
	$selected = $select->fetch();
	if($selected['categorie'] == $option) {
		return true;
	}else{
		return false;
	}
}
function sCat($option,$id){
	$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
	$select = $bdd->query('SELECT * FROM articles WHERE id="'.$id.'"');
	$selected = $select->fetch();
	if($selected['sous_categorie'] == $option) {
		return true;
	}else{
		return false;
	}
}	
 
?>
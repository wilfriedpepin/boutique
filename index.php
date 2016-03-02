<?php 
SESSION_START(); 
$bdd = new PDO('mysql:host=localhost;dbname=boutique','root','');
$dernier = $bdd->query("SELECT * FROM articles ORDER BY id DESC LIMIT 1");
$listedernier = $dernier ->fetch();
$avantdernier = $bdd->query("SELECT * FROM articles ORDER BY id DESC LIMIT 1,1");
$listeavantdernier = $avantdernier->fetch();
$avantavantdernier = $bdd->query("SELECT * FROM articles ORDER BY id DESC LIMIT 2,1");
$listeavantavantdernier = $avantavantdernier->fetch();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="index__style.css">
</head>
<body>
	<?php require_once('header.php'); ?>
	<main>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2 col-sm-12 col-xs-12">
					<div class="main__categorie">
						<div class="main__categorie1"><a href="categorie_shonen.php">Shônen</a></div>
						<div class="main__categorie2"><a href="categorie_shoujo.php">Shoujo</a></div>
						<div class="main__categorie3"><a href="categorie_seinen.php">Seinen</a></div>
						<div class="main_categorie6"><a href="listing.php">Voir tout</a></div>
					</div>
				</div>
				<h1>LES DERNIERS ARTICLES AJOUTÉS:</h1><br>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php 
						echo '<a href="vue_article.php?ref='.$listedernier['id'].'"><img src="'.$listedernier['image'].'" alt="lol" height="300px" width="225px"></a>';
						echo '<br>'.'nom:'.$listedernier['nom'].'<br>';
						echo 'tome:'.$listedernier['tome'].'<br>';
					?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					 <?php 
					 	echo'<a href="vue_article.php?ref='.$listeavantdernier['id'].'"><img src="'.$listeavantdernier['image'].'" alt="lol" height="300px" width="225px"></a>';
						echo '<br>'.'nom:'.$listeavantdernier['nom'].'<br>';
						echo 'tome:'.$listeavantdernier['tome'].'<br>';
					?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php 
						echo '<a href="vue_article.php?ref='.$listeavantavantdernier['id'].'"><img src="'.$listeavantavantdernier['image'].'" alt="lol" height="300px" width="225px"></a>';
						echo '<br>'.'nom:'.$listeavantavantdernier['nom'].'<br>';
						echo 'tome:'.$listeavantavantdernier['tome'].'<br>';
					?>
				</div>
			</div>
			<div>
				<h2>L'Actualité en bref</h2>
			</div>
			
	</main>
	
</body>
</html>
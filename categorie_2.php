<?php  
	echo '<div class="container-fluid">';
		echo '<div class="row ">';
			while ($listing = $liste->fetch()){
				//ici on affiche tant qu'il y a encore des donnée dans la bdd 
				echo '<div class="col-md-4 col-sm-6 col-xs-12 article">';
					echo '<a href="vue_article.php?ref='.$listing['id'].'">';
					echo '<img class="img-responsive image" src="'.$listing['image'].'" alt="lol"></a>';
						echo 'TITRE: '.$listing['nom'].'<br>';
						echo 'TOME: '.$listing['tome'].'<br>';
						echo 'Reférence: '.$listing['reference'].'<br>';
						echo 'prix: '.$listing['prix'].'€<br>';
						echo 'categorie: '.$listing['categorie'];
						if (!empty($listing['sous_categorie'])){
							echo '/'.$listing['sous_categorie'].'<br>';
						}
				echo '</div>';
			}
		echo '</div>';
	echo '</div>';
?>
		</body>
		</html>

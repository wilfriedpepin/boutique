<link rel="stylesheet" href="header.css">
<header>
	<nav>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<nav class="navbar navbar-inverse">
				      <div class="container">
				        <div class=" navbar-header nav_header">
				          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				          </button>
				          <a class="navbar-brand" href="#"></a>
				        </div>
				        <div id="navbar" class="collapse navbar-collapse">
				          <ul class="nav navbar-nav list_nav">
				            <li class="active"><a href="index.php">Accueil</a></li>
				            
				            <li><a class="navigation__contact"href="contact.php">Contact</a></li>
				            <?php  
				            	if(!empty($_SESSION['pseudo']) && !empty($_SESSION['mdp'])){
				            		echo '<li><a class="navigation__boutique" href="profil.php">Profil</a></li>';
				            		echo '<li><a href="deconnexion.php">Me Déconnecter</a></li>';
				            		echo '<li><a href="panier.php">Mes achats</a></li>';
				            		if ($_SESSION['pseudo'] == 'admin'){
				            			echo '<li><a href="admin/vue_article.php">Back Office</a></li>';
				            		}
				            		}else{
					            		echo '<li><a href="connexion.php">Me Connecter</a></li>';
					           		}					        
				  
				             ?>
				             <li>
				             	<form method="post">
				             		<input type="text" name="search" id="search" class="barre_recherche" placeholder="Entrez votre recherche ici">
				             		<input type="submit">
				             	</form>
				             </li>
				          </ul>
				        </div><!--/.nav-collapse -->
				      </div>
		    		</nav>
	    		</div>
			</div>
		</div>
	</nav>
</header>
<?php 
if (!empty($_POST['search'])){
	$recherche = htmlspecialchars($_POST['search']);
	header('Location:recherche.php?recherche='.$recherche);
}
 ?>
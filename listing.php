	<?php 
		session_start();
		require_once('categorie_1.php');
		$liste = $bdd->query("SELECT * FROM articles ORDER BY nom,tome");
		require_once('categorie_2.php');
	 ?>
</body>
</html>
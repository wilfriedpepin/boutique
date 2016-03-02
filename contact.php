<?php session_start();?>
<!DOCTYPE html>
 <html>
 <head>
 	<title>Contact</title>
 	<meta charset="utf-8">
 	<link rel="stylesheet" href="bootstrap.css">
 </head>
 <body>
 	<?php require_once('header.php'); ?>
 		<main class="container">
	 	<div class="row">
	 		<div class="col-md-12">
	 			<h2>Demande De Contact</h2>
	 			<form action="mailto:wilfried.pepin@outlook.fr" method="post">
				 	<fieldset>
				 		<div class="form-group">
				 			<label for="pseudo">Identifiant</label>
				 			<input type="text" id="pseudo" name="pseudo" class="form-control">
				 		</div>
				 		<div class="form-group">
					 		<label for="formulaire">Message:</label>
							<textarea name="formulaire" id="formulaire" cols="30" rows="10" class="form-control"></textarea>
				 		</div>
				 		<input type="submit">
				 	</fieldset>
				 </form>
	 		</div>
	 	</div>
	 </main>
 </body>
 </html>
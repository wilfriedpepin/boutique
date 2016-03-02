var prix_total = <?php= $prix_total; ?>;
if(prix_total == 0){
	document.getElementById('command_button').disabled = true;
}else{
	document.getElementById('command_button').disabled = false;
}
alert('coucou');
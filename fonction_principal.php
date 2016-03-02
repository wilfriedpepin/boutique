<?php 
function checkPseudo($liste,$pseudo){
	while($liste){
		if($liste['pseudo'] == $pseudo){
			return true;
		}
	}
		return false;
}

 ?>
<?php
if(isset($_SESSION['connect'])){
	$bdd = new connexion();
	$selRdv = "SELECT * FROM utilisateur where id = :id;";
	$rep = $bdd->prepareQuery($selRdv, array(':id' => $_SESSION['id']));
}
?>
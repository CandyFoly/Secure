<?php
if(Chiffrement::decrypt($_SESSION['type']) == "patient"){
	$bdd = new connexion();
	$selRdv = "SELECT * FROM rendez_vous where id_patient = :idP ORDER BY date DESC;";
	$rep = $bdd->prepareQuery($selRdv, array(":idP" => Chiffrement::decrypt($_SESSION["id"])));

	$sel = "SELECT DISTINCT DATE(NOW()) AS jour FROM rendez_vous;";
	$repD = $bdd->prepareQuery($sel, array());
}
else if(Chiffrement::decrypt($_SESSION['type']) == "medecin"){
	$bdd = new connexion();
	$selRdv = "SELECT * FROM rendez_vous where id_medecin = :idP ORDER BY date DESC;";
	$rep = $bdd->prepareQuery($selRdv, array(":idP" => Chiffrement::decrypt($_SESSION["id"])));

	$sel = "SELECT DISTINCT DATE(NOW()) AS jour FROM rendez_vous;";
	$repD = $bdd->prepareQuery($sel, array());
}
if (isset($_POST['AjoutRdv'])) {
	
	header('Location:ajouter-rendez-vous');
}
?> 
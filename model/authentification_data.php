<?php
if(isset($_POST['connexion'])){
	$bdd = new connexion();
	$ins = "SELECT * FROM utilisateur where login = :login AND pass = :pass ;";
	$rep = $bdd->prepareQuery($ins, array(":login" => $_POST['login'],
										  ":pass" => $_POST['mot_de_passe']));

	$ins = "SELECT * FROM type_user where id = :id ;";
	$rep_user = $bdd->prepareQuery($ins, array(":id" => $rep[0]->type));

	if(sizeof($rep) == 1){
		$_SESSION["id"] = $rep[0]->id;
		$_SESSION['connect'] = 1;
		$_SESSION['type'] = $rep_user[0]->libelle;

		header('Location: accueil');
	}
}
?>
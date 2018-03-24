<?php
if(isset($_SESSION['connect'])){
	$bdd = new connexion();
	if(Chiffrement::decrypt($_SESSION['type']) == 'patient'){
		$sel = "SELECT utilisateur.id, nom, prenom, telephone, adresse, mTraitant, num_secu, mail FROM utilisateur, type_user, occuper WHERE utilisateur.type =type_user.id AND utilisateur.id = occuper.id_medecin AND id_patient = :id ";
		$rep = $bdd->prepareQuery($sel, array(":id" => Chiffrement::decrypt($_SESSION["id"])));
	}else if(Chiffrement::decrypt($_SESSION['type']) == 'administrateur'){
		$sel = "SELECT utilisateur.id, nom, prenom, telephone, adresse, mTraitant, num_secu, type, service, pass, login, mail, service.libelle, localisation FROM utilisateur, type_user, service WHERE utilisateur.type =type_user.id AND utilisateur.service = service.id AND type_user.libelle = :lib";
		$rep = $bdd->prepareQuery($sel, array(':lib' => "medecin"));
	}
}
?>
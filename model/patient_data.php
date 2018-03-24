<?php
if(isset($_SESSION['connect'])){
		$bdd = new connexion();
	if(Chiffrement::decrypt($_SESSION['type']) == 'medecin'){
		$sel = "SELECT utilisateur.id, nom, prenom, telephone, adresse, mTraitant, num_secu, mail FROM utilisateur, type_user, occuper WHERE utilisateur.type =type_user.id AND utilisateur.id = occuper.id_patient AND id_medecin = :id ";
		$rep = $bdd->prepareQuery($sel, array(':id' => Chiffrement::decrypt($_SESSION['id'])));
	}else if(Chiffrement::decrypt($_SESSION['type']) == 'administrateur'){
		$sel = "SELECT utilisateur.id, nom, prenom, telephone, adresse, mTraitant, num_secu, mail FROM utilisateur, type_user, occuper WHERE utilisateur.type =type_user.id AND libelle = :lib";
		$rep = $bdd->prepareQuery($sel, array(':lib' => 'patient'));
	}
}

?>
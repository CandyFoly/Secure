<?php
if(isset($_SESSION['connect'])){
	if(Chiffrement::decrypt($_SESSION['type']) == 'administrateur'){
		$id = substr($_SERVER['REQUEST_URI'], 23);
		if($id != ''){
			$bdd = new connexion();
			if(isset($_POST['suppression'])){
				$up = "UPDATE utilisateur SET etat = :etat WHERE id=:id";
				$repup = $bdd->prepare($up, array(':etat' => 1, ':id' => Chiffrement::decrypt($id)));
			}else if(isset($_POST['annulation'])){
				$up = "UPDATE utilisateur SET etat = :etat WHERE id=:id";
				$repup = $bdd->prepare($up, array(':etat' => 0, ':id' => Chiffrement::decrypt($id)));
			}else if(isset($_POST['reinitialisation'])){
				$up = "UPDATE utilisateur SET pass = :pass WHERE id=:id";
				$repup = $bdd->prepare($up, array(':pass' => Chiffrement::genereationMDP(), ':id' => Chiffrement::decrypt($id)));
				
			}
			$sel = "SELECT utilisateur.id, etat, nom, prenom, telephone, adresse, service.libelle, service.localisation, mail FROM utilisateur, service WHERE utilisateur.service = service.id AND utilisateur.id = :id;";
			$rep = $bdd->prepareQuery($sel, array(':id' => Chiffrement::decrypt($id)));
			if(isset($_POST)){unset($_POST);}
		}
	}
}
?>
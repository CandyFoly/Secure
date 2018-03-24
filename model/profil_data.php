<?php
if(isset($_SESSION['connect'])){
	$bdd = new connexion();
	if(isset($_POST['envoyer'])){
		if(Chiffrement::decrypt($_SESSION['type']) == 'patient' || Chiffrement::decrypt($_SESSION['type']) == 'medecin'){
			$sel = "SELECT * FROM utilisateur_temp WHERE id = :id;";
			$rep = $bdd->prepareQuery($ins, array(':id' => Chiffrement::decrypt($_SESSION['id'])));
			if(isset($rep)){
				$del = "DELETE FROM utilisateur_temp WHERE id = :id";
				$repins = $bdd->prepareQuery($del, array(':id' => Chiffrement::decrypt($_SESSION['id'])));
			}
			$ins = "INSERT INTO utilisateur_temp(id, nom, prenom, telephone, adresse, mTraitant, num_secu, type, service, pass, login, mail SELECT id, nom, preom, telephone, adresse, mTraitant, num_secu, type, service, pass, login, mail FROM utilisateur WHERE utilisateur.id = :id ;";
			$repins = $bdd->prepareQuery($ins, array(':id' => Chiffrement::decrypt($_SESSION['id'])));
			if($repins == true){
				echo "La demande de modification a bien été pris en compte et envoyer à l'administrateur. Les nouvelle information s'afficherons lorsque l'administrateur les aura validé.";
			}
		}else if(Chiffrement::decrypt($_SESSION['type']) == 'administrateur'){
			if(isset($_POST['pass'])){
				$up = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, telephone = :tel, adresse = :adr, pass = :pass, login = :login, mail = :mail WHERE id = :id";
				$rep = $bdd->prepareQuery($up, array('nom' => $_POST['nom'],
													 ':prenom' => $_POST['prenom'],
													 'tel' => $_POST['tel'],
													 ':adr' => $_POST['adresse'],
													 ':mail' => $_POST['mail'],
													 ':pass' => $_POST['pass'],
													 ':login' => $_POST['login'],
													 ':id' => Chiffrement::decrypt($_SESSION['id'])));
			}else{
				$up = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, telephone = :tel, adresse = :adr, login = :login, mail = :mail WHERE id = :id";
				$rep = $bdd->prepareQuery($up, array('nom' => $_POST['nom'],
													 ':prenom' => $_POST['prenom'],
													 'tel' => $_POST['tel'],
													 ':adr' => $_POST['adresse'],
													 ':mail' => $_POST['mail'],
													 ':login' => $_POST['login'],
													 ':id' => Chiffrement::decrypt($_SESSION['id'])));
			}
		}
	}
	$sel = "SELECT * FROM utilisateur WHERE id = :id";
	$rep = $bdd->prepareQuery($sel, array(':id' => Chiffrement::decrypt($_SESSION['id'])));
}
?>
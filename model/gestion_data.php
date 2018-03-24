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
				/*$up = "UPDATE utilisateur SET pass = :pass WHERE id=:id";
				$repup = $bdd->prepare($up, array(':pass' => Chiffrement::genereationMDP(), ':id' => Chiffrement::decrypt($id)));
				if($repup == true){
					$sel = "SELECT * FROM utilisateur WHERE id = :id;";
						$repsel = $bdd->prepareQuery($sel, array(':id' => Chiffrement::decrypt($id)));
					//$to = $repsel[0]->mail;
					$to = "kissdxl972@gmail.com";
					$sujet = "Changement du mot de passe de votre compte";
					$message = "Bonjour, nous vous informons que suite a votre demande votre mot de passe à été réinitialisé. Voici le nouveau mot de passe = ".$repsel[0]->pass.". Il vous est conseillé de modifier ce mot de passe dès votre prochaine connection.";
					$header = 'From: webmaster@example.com' . "\r\n" .
     'Reply-To: webmaster@example.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
					mail($to, $sujet, $message, $header);
				}*/
			}
			$sel = "SELECT utilisateur.id, etat, nom, prenom, telephone, adresse, service.libelle, service.localisation, mail FROM utilisateur, service WHERE utilisateur.service = service.id AND utilisateur.id = :id;";
			$rep = $bdd->prepareQuery($sel, array(':id' => Chiffrement::decrypt($id)));
			if(isset($_POST)){unset($_POST);}
		}
	}
}
?>
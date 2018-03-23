<?php
if(isset($_SESSION['id'])){
	$bdd = new connexion();
	$sel = "SELECT id FROM utilisateur WHERE EXISTS (SELECT id FROM utilisateur WHERE id = :id);";
	$rep = $bdd->prepare($sel, array(":id"=>Chiffrement::decrypt($_SESSION['id'])));
	if(isset($rep)){
		$id = substr($_SERVER['REQUEST_URI'], 27);
		if(Chiffrement::decrypt($_SESSION['type']) == "medecin"){
			if (isset($_POST["modifierRdv"])) {
				$upd = "UPDATE rendez_vous SET descriptif = :descriptif, 
												id_medecin = :med,
												id_patient = :pat,
												date = :date,
												heure = :heure
												WHERE id = :idRdv";
				if(Secure::protectSQL($_POST["descriptif"]) == true){
					$req = $bdd->prepare($upd, array(":descriptif" => htmlspecialchars($_POST["descriptif"]),
													":med" => Chiffrement::decrypt($_SESSION["id"]),
													":pat" => Chiffrement::decrypt($_POST["lstPatient"]),
													":date" => $_POST["d"],
													":heure" => $_POST["tHeure"],
													":idRdv" => Chiffrement::decrypt($id)));
					if($req == true){
						/*	$sel = "SELECT nom, prenom FROM utilisateur WHERE id = :id";
							$rep = $bdd->prepare($sel, array(':id' => Chiffrement::decrypt($_SESSION['id'])));

							$texte = "Bonjour nous vous informons que le docteur".$rep[0]->nom." ".$rep[0]->prenom." vient de faire quellqeus modification pour votre rendez-vous. Les nouvelles informations : Rendez-vous le ".$_POST["d"]." à ".$_POST["tHeure"];
						
							$ins = "INSERT INTO message (texte, destinataire, expediteur) VALUES(:texte, :destinataire, :expediteur);";
							$req = $bdd->prepare($ins, array( ':texte' => $texte,
															  ':destinataire' => Chiffrement::decrypt($_POST["lstPatient"]),
															  ':expediteur' => Chiffrement::decrypt($_SESSION['id'])));*/
					}
				}else{
					echo "Désolé mais il s'emblerait que vosu ayez utilisé des caractères non autorisés.";
				}	
			}
			if (isset($_POST["ajouterRdv"])) {
				$ins = "INSERT INTO rendez_vous(date, heure, id_medecin, id_patient, descriptif) VALUES(:date, :heure, :med, :pat, :descriptif);";
				$bdd = new connexion();
				$req = $bdd->prepare($ins, array(":date" => $_POST["d"], 
												":heure" => $_POST["tHeure"],
												":med" => Chiffrement::decrypt($_SESSION["id"]),
												":pat" => Chiffrement::decript($_POST["lstPatient"]),
												":descriptif" => $_POST["descriptif"]));
			}
		}
		else if(Chiffrement::decrypt($_SESSION['type']) == "patient"){
			if (isset($_POST["modifierRdv"])) {
				$bdd = new connexion();
				$upd = "UPDATE rendez_vous SET descriptif = :descriptif, 
												id_medecin = :med,
												id_patient = :pat,
												date = :date,
												heure = :heure
												WHERE id = :idRdv";	
				$req = $bdd->prepare($upd, array(":descriptif" => $_POST["descriptif"],
												":med" => $_POST["lstMedecin"],
												":pat" => $_SESSION["id"],
												":date" => $_POST["d"],
												":heure" => $_POST["tHeure"],
												":idRdv" => $_GET["idRdv"]));
			}

			if (isset($_POST["ajouterRdv"])) {
				$ins = "INSERT INTO rendez_vous(date, heure, id_medecin, id_patient, descriptif) VALUES(:date, :heure, :med, :pat, :descriptif);";
				$bdd = new connexion();
				$req = $bdd->prepare($ins, array(":date" => $_POST["d"], 
												":heure" => $_POST["tHeure"],
												":med" => $_POST["lstMedecin"],
												":pat" => $_SESSION["id"],
												":descriptif" => $_POST["descriptif"]));
			}
		}

		if (isset($_POST["Annuler"])) {
			header("Location:rdv");
		}
	}
}
?>
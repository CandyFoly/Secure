<?php
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

if (isset($_POST["Annuler"])) {
	header("Location:rdv");
	//echo "string";
}
?>
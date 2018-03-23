<div class='div' id='article'>
<?php
$id = substr($_SERVER['REQUEST_URI'], 27);
$bdd = new connexion();
$selM = "SELECT utilisateur.id as idU, nom, prenom FROM utilisateur, type_user WHERE utilisateur.type = type_user.id AND libelle = :libelle";
if(Chiffrement::decrypt($_SESSION['type']) == "patient")$repM = $bdd->prepareQuery($selM, array(":libelle" => "medecin"));
else if(Chiffrement::decrypt($_SESSION['type']) == "medecin")$repM = $bdd->prepareQuery($selM, array(":libelle" => "patient"));

if($id == ''){?>
	<form method="post" action="ajouter-rendez-vous">
	<label>Description</label>
	<textarea rows="2" name="descriptif"></textarea>
	<label>Date</label>
	<input type="date" name="d">
	<label>Heure</label>
	<input type="time" name="tHeure">
	<label>Medecin</label>
	<?php

		if(Chiffrement::decrypt($_SESSION['type']) == "patient")echo '<select name="lstMedecin">';
		else if(Chiffrement::decrypt($_SESSION['type']) == "medecin")echo '<select name="lstPatient">';
		for ($i=0; $i < sizeof($repM); $i++) { 
			if(Chiffrement::decrypt($_SESSION['type']) == "medecin")echo '<select name="lstPatient">';
			echo "<option value='".Chiffrement::crypt($repM[$i]->idU)."'>".$repM[$i]->prenom." ".$repM[$i]->nom."</option>";
		}
	?>

	</select>
	<input type="submit" name="ajouterRdv" value="Ajouter le rendez-vous">
	<input type="submit" name="Annuler" value="Annuler">
	</form>
	<?php
}
else {
	$selRdv = "SELECT * FROM rendez_vous where id = :idR;";
	$rep = $bdd->prepareQuery($selRdv, array(":idR" => Chiffrement::decrypt($id)));
	var_dump(Chiffrement::decrypt($id));
	$selM = "SELECT * FROM utilisateur WHERE id = :idM";
	if(Chiffrement::decrypt($_SESSION['type']) == "patient")$repMed = $bdd->prepareQuery($selM, array(":idM" => $rep[0]->id_medecin));
	else if(Chiffrement::decrypt($_SESSION['type']) == "medecin")$repMed = $bdd->prepareQuery($selM, array(":idM" => $rep[0]->id_patient));
	echo "<form method='post' action='".Html::redirection()."rendez-vous/".$id."'>
		<label>Description</label>
		<textarea rows='2' name='descriptif'>".$rep[0]->descriptif."</textarea>
		<label>Date</label>
		<input type='date' name='d' value='".$rep[0]->date."'>
		<label>Heure</label>
		<input type='time' name='tHeure' value='".$rep[0]->heure."'>
		<label>Medecin</label>";
		if(Chiffrement::decrypt($_SESSION['type']) == "patient")echo "<select name='lstMedecin'>";
		if(Chiffrement::decrypt($_SESSION['type']) == "medecin")echo "<select name='lstPatient'>";
		echo "<option value='".Chiffrement::crypt($repMed[0]->id)."'>".$repMed[0]->prenom." ".$repMed[0]->nom."</option>";
			for ($i=0; $i < sizeof($repM); $i++) {
				echo "<option value='".Chiffrement::crypt($repM[$i]->idU)."'>".$repM[$i]->prenom." ".$repM[$i]->nom."</option>";
			}
	echo "</select>
		<input type='submit' name='modifierRdv' value='Modifier le rendez-vous'>
		<input type='submit' name='Annuler' value='Annuler'>
	</form>";

}

?>
</div>
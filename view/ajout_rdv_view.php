<?php
$bdd = new connexion();
$selM = "SELECT utilisateur.id as idU, nom, prenom FROM utilisateur, type_user WHERE utilisateur.type = type_user.id AND libelle = :libelle";
$repM = $bdd->prepareQuery($selM, array(":libelle" => "medecin"));

if (isset($_GET['idRdv'])) {
	$selRdv = "SELECT * FROM rendez_vous where id = :idR;";
	$rep = $bdd->prepareQuery($selRdv, array(":idR" => $_GET['idRdv']));

	$selM = "SELECT * FROM utilisateur WHERE id = :idM";
$repMed = $bdd->prepareQuery($selM, array(":idM" => $rep[0]->id_medecin));
//var_dump($rep);
	var_dump($_SESSION);

echo "<form method='post' action='ajoutRdv'>
	<label>Description</label>
	<textarea rows='2' name='descriptif'>".$rep[0]->descriptif."</textarea>
	<label>Date</label>
	<input type='date' name='d' value='".$rep[0]->date."'>
	<label>Heure</label>
	<input type='time' name='tHeure' value='".$rep[0]->heure."'>
	<label>Medecin</label>
	<select name='lstMedecin'>";
	echo "<option name='".$repMed[0]->id."'>".$repMed[0]->prenom." ".$repMed[0]->nom."</option>";
		for ($i=0; $i < sizeof($repM); $i++) {
			echo "<option name='".$repM[$i]->id."'>".$repM[$i]->prenom." ".$repM[$i]->nom."</option>";
		}
echo "</select>
	<input type='submit' name='modifierRdv' value='Modifier le rendez-vous'>
	<input type='submit' name='Annuler' value='Annuler'>
</form>";

}
else{
	?>
<form method="post" action="ajoutRdv">
	<label>Description</label>
	<textarea rows="2" name="descriptif"></textarea>
	<label>Date</label>
	<input type="date" name="d">
	<label>Heure</label>
	<input type="time" name="tHeure">
	<label>Medecin</label>
	<select name="lstMedecin">
		<?php
		for ($i=0; $i < sizeof($repM); $i++) { 
			echo "<option value='".$repM[$i]->idU."'>".$repM[$i]->prenom." ".$repM[$i]->nom."</option>";
		}
		?>
	</select>
	<input type="submit" name="ajouterRdv" value="Ajouter le rendez-vous">
	<input type="submit" name="Annuler" value="Annuler">
</form>
	<?php
}
?>
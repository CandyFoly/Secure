<?php
echo "get".$_GET["med"];
if (isset($_GET["med"])) {
	$selMes = "SELECT * FROM utilisateur WHERE id = :id;";
	$bdd = new connexion();
	$rep = $bdd->prepareQuery($selMes, array(":id" => $_GET["med"]));
}
?>
<form method="post" action="message_main.php">
	<label>Destinataire</label>
	<input type="text" name="txtDes" value="<?php echo $rep[0]->prenom." ".$rep[0]->nom; ?>"><br>
	<label>Objet</label>
	<input type="text" name="txtObjet"><br>
	<label>Message</label>
	<textarea rows="4" name="txtTexte"></textarea><br>
	<input type="submit" name="envoyer" value="Envoyer">
</form>
<?php
if (isset($_POST["envoyer"])) {
	$ins = "INSERT INTO message(date, heure, texte, destinataire, expediteur) VALUES(:d, :h, :texte, :destinataire, :expediteur)";
	$bdd = new connexion();
	$rep = $bdd->prepare($ins, array(":d" => "NOW()",
									":h" => "",
									":texte" => $_POST["txtTexte"], 
									":destinataire" => $_GET["med"],
									":expediteur" => $_SESSION["id"]));
}
?>
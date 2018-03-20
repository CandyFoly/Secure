<?php
$bdd = new connexion();
$sel = "SELECT * FROM rendez_vous where id_patient = :idP;";
$rep = $bdd->prepareQuery($sel, array(":idP" => $_SESSION["id"]));
//var_dump($rep);
?>

<form method="post" action="medecin">
	<table>
		<?php
		for ($i=0; $i < sizeof($rep); $i++) {
		 	$selM = "SELECT utilisateur.id, prenom, nom, libelle FROM utilisateur, service WHERE utilisateur.service = service.id AND utilisateur.id = :idM";
		 	$repM = $bdd->prepareQuery($selM, array(":idM" => $rep[$i]->id_medecin));
		 	//var_dump($repM);
			echo "<tr>";
			echo "<td>".$repM[0]->prenom." ".$repM[0]->nom."</td>";
			echo "<td>".$repM[0]->libelle."</td>";
			echo "<td><a href='controller/message_main.php?med=".$repM[0]->id."'>Envoyer un message</a></td>";
			echo "</tr>";
		}
		?>
	</table>
</form>
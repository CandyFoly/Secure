<div id="article" class="div">
<table>
<?php
if(isset($rep)){
	if(Chiffrement::decrypt($_SESSION['type']) == "patient"){
			for ($i=0; $i < sizeof($rep); $i++) {
				$selM = "SELECT * FROM utilisateur WHERE id = :idM;";
				$reqM = $bdd->prepareQuery($selM, array(":idM" => $rep[$i]->id_medecin));
				echo "<tr>";
				echo "<td>".$rep[$i]->date.""."</td>";
				echo "<td>".$rep[$i]->descriptif."</td>";
				echo "<td>".$reqM[0]->prenom." ".$reqM[0]->nom."</td>";
				if ($rep[$i]->presence == 0) {
					echo "<td>Absent</td>";
				}
				else{
					echo "<td>Present</td>";
				}
					if ($rep[$i]->date > $repD[0]->jour) {
					echo "<td><a href='controller/ajout_rdv_main.php?idRdv=".$rep[$i]->id."'>Modifier</a></td>";
				}
			}
	}
	else if(Chiffrement::decrypt($_SESSION['type']) == "medecin"){
		for ($i=0; $i < sizeof($rep); $i++) {
			$selM = "SELECT * FROM utilisateur WHERE id = :idM;";
			$reqM = $bdd->prepareQuery($selM, array(":idM" => $rep[$i]->id_patient));
			$selO = "SELECT * FROM ordonnace WHERE rdv = :rdv;";
			echo "<tr>";
			echo "<td>".$rep[$i]->date.""."</td>";
			echo "<td>".$rep[$i]->descriptif."</td>";
			if ($rep[$i]->date > $repD[0]->jour) {
				echo "<td><a href='rendez-vous/".Chiffrement::crypt($rep[$i]->id)."'>".$reqM[0]->prenom." ".$reqM[0]->nom."</a></td>";
			}else{
				echo "<td>".$reqM[0]->prenom." ".$reqM[0]->nom."</td>";
			}
			if ($rep[$i]->presence == 0) {
				echo "<td>Absent</td>";
			}
			else{
				echo "<td>Present</td>";
			}
		}
	}
}
else{
	echo 'Vous n\'avez pas de rendez vous';
}
?>	
</table>
<?php 
	if(Chiffrement::decrypt($_SESSION['type']) == "medecin")echo '<a href="ajouter-rendez-vous">Ajouter Rendez-vous</a>';
	else if(Chiffrement::decrypt($_SESSION['type']) == "medecin")echo '<a href="ajouter-rendez-vous">Prendre Rendez-vous</a>';
?>
</div>
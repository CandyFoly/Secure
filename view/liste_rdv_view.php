<?php
echo $_SESSION["id"];
if($_SESSION['type'] == "patient"){
	$bdd = new connexion();
	$selRdv = "SELECT * FROM rendez_vous where id_patient = :idP ORDER BY date DESC;";
	$rep = $bdd->prepareQuery($selRdv, array(":idP" => $_SESSION["id"]));

	$sel = "SELECT DISTINCT DATE(NOW()) AS jour FROM rendez_vous;";
	$repD = $bdd->prepareQuery($sel, array());
	var_dump($repD);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Rendez-vous</title>
	</head>
	<body>
	<form method="post" action="rdv">
		<table>
		<?php
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
				//$_SESSION["mod"] = $rep[$i]->id;

				if ($rep[$i]->date > $repD[0]->jour) {
					echo "<td><a href='controller/ajout_rdv_main.php?idRdv=".$rep[$i]->id."'>Modifier</a></td>";
				}
				echo "<td>".$_SESSION["mod"]."</td>";
				echo "</tr>";
				//unset($_SESSION["mod"]);
				//$_SESSION["mod"] = $rep[$i]->id;
				echo "session : ".$_SESSION["mod"];
			}
		?>	
		</table>
		<input type="submit" name="AjoutRdv" value="Prendre un rendez-vous">
	</form>
	</body>
</html>

<?php
$bdd = new connexion();
$sel = "SELECT * FROM ordonnance, rendez_vous WHERE ordonnance.rdv = rendez_vous.id AND id_patient = ".$_SESSION['id'].";";
$rep = $bdd->prepareQuery($sel, array());
//var_dump($rep);
?>

<form method="post" action="suivis">
	<table>
			<?php
			for ($i=0; $i < sizeof($rep); $i++) { 
				echo "<tr>";
				echo "<td>".$rep[$i]->medecin."</td>";
				echo "<td>".$rep[$i]->lst_medicament."</td>";
				echo "<td>".$rep[$i]->descriptif."</td>";
				echo "<td>".$rep[$i]->date."</td>";
				echo "</tr>";
			}
			?>
	</table>
</form>
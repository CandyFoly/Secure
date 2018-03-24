<div class="div" id="article">
<?php
if(isset($_SESSION['connect'])){
	if(Chiffrement::decrypt($_SESSION['type']) == "patient"){
		$id = substr($_SERVER['REQUEST_URI'], 23);
		if($id == ''){
			?>
			<form method="post" action="medecin">
				<table>
					<?php
					for ($i=0; $i < sizeof($rep); $i++) {
					 	$selM = "SELECT utilisateur.id, prenom, nom, libelle FROM utilisateur, service WHERE utilisateur.service = service.id AND utilisateur.id = :idM";
					 	$repM = $bdd->prepareQuery($selM, array(":idM" => $rep[$i]->id));
						echo "<tr>";
						echo "<td>".$repM[0]->prenom." ".$repM[0]->nom."</td>";
						echo "<td>".$repM[0]->libelle."</td>";
						echo "<td><a href='controller/message_main.php?med=".$repM[0]->id."'>Envoyer un message</a></td>";
						echo "</tr>";
					}
					?>
				</table>
			</form>
			<?php
		}else{}
	}else if(Chiffrement::decrypt($_SESSION['type']) == "administrateur"){
		?><table>
			<?php
				for ($i=0; $i < sizeof($rep); $i++) {
					echo "<tr>";
					echo "<td>".$rep[0]->prenom." ".$rep[0]->nom."</td>";
					echo "<td>".$rep[0]->libelle."</td>";
					echo "<td><a href='gestion/".Chiffrement::crypt($rep[0]->id)."'>Gestion</a></td>";
					echo "</tr>";
				}
				?>
		</table><?php
	}
}?>
</div>
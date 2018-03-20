<?php
$id = substr($_SERVER['REQUEST_URI'], 30);
if($id == ''){
	?>
	<table>
		<thead>
			<th>Nom</th>
			<th>Prenom</th>
		</thead>
		<tbody>
			<?php
				foreach($rep as $key=>$value){
					echo '<td><a href="patient/'.Chiffrement::crypt($rep[$key]->id).'">'.$rep[$key]->nom.'</a></td>
						  <td>'.$rep[$key]->prenom.'</td>';
				}
			?>
		</tbody>
	</table>
	<?php
}else{
	$bdd = new connexion();
	$sel = "SELECT * FROM utilisateur WHERE id = :id;";
	$rep = $bdd->prepareQuery($sel, array(':id'=>Chiffrement::decrypt($id)));
	echo '<table>
			<tr>
				<td><label>Nom : </label></td>
				<td><label>'.$rep[0]->nom.'</label></td>
				<td><label>Prénom : </label></td>
				<td><label>'.$rep[0]->prenom.'</label></td>
				<td><label>Téléphone : </label></td>
				<td><label>'.$rep[0]->telephone.'</label></td>
				<td><label>E-mail : </label></td>
				<td><label>'.$rep[0]->mail.'</label></td>
			</tr>
			<tr>
				<td><label>Adresse : </label></td>
				<td><label>'.$rep[0]->adresse.'</label></td>
				<td><label>Médecin<br/>
							Traitant : </label></td>
				<td><label>'.$rep[0]->mTraitant.'</label></td>
				<td><label>Numéro<br/>
							Securité Social : </label></td>
				<td><label>'.$rep[0]->num_secu.'</label></td>
			</tr>
		</table>';
}
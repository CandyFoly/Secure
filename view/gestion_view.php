<div class="div" id="article">
<?php
if(isset($_SESSION['connect'])){
	if(Chiffrement::decrypt($_SESSION['type']) == 'administrateur'){
		$id = substr($_SERVER['REQUEST_URI'], 23);
		if($id != ''){

			echo $id;
			echo '<table>
					<tr>
						<td><label>Nom : </label></td>
						<td><label>'.$rep[0]->nom.'</label></td>
					</tr>
					<tr>
						<td><label>Prénom : </label></td>
						<td><label>'.$rep[0]->prenom.'</label></td>
					</tr>
					<tr>
						<td><label>Service : </label></td>
						<td><label>'.$rep[0]->libelle.'</label></td>
					</tr>
					<tr>
						<td><label>Service : </label></td>
						<td><label>'.$rep[0]->localisation.'</label></td>
					</tr>
					<tr>
						<td><label>E-mail : </label></td>
						<td><label>'.$rep[0]->mail.'</label></td>
					</tr>
					<tr>
						<td><label>Adresse : </label></td>
						<td><label>'.$rep[0]->adresse.'</label></td>
					</tr>
				</table>
				<table>
					<tr>
						<td>
							<form method="post" action="'.Html::redirection().'gestion/'.$id.'">';
							if($rep[0]->etat == 0) echo '<input type="submit" value="Supprimer le compte" name="suppression"/>';
							else if($rep[0]->etat == 1) echo '<input type="submit" value="Annuler la suppression" name="annulation"/>';
					echo 	'</form>';
					echo '</td>
						<td>
							<form method="post" action="'.Html::redirection().'gestion/'.$id.'">
								<input type="submit" value="Réinitialiser mot de passe" name="reinitialisation"/>
							</form>
						</td>
					</tr>
				</table>';
					echo 'Le compte utilisateur ne seras pas supprimer sans l\'accord de leur propriètaire.';
		}
	}
}
?>
</div>
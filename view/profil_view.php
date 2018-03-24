<div class="div" id="article">
<?php
if(isset($_SESSION['connect'])){
	$id = substr($_SERVER['REQUEST_URI'], 23);
	if($id == ''){
		echo '<a href="'.Html::redirection().''.Chiffrement::crypt('modifier').'">Modifier</a>';
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
					<td><label>Téléphone : </label></td>
					<td><label>'.$rep[0]->telephone.'</label></td>
				</tr>
				<tr>
					<td><label>E-mail : </label></td>
					<td><label>'.$rep[0]->mail.'</label></td>
				</tr>
				<tr>
					<td><label>Adresse : </label></td>
					<td><label>'.$rep[0]->adresse.'</label></td>
				</tr>
				<tr>
					<td><label>Médecin Traitant : </label></td>
					<td><label>'.$rep[0]->mTraitant.'</label></td>
				</tr>
				<tr>
					<td><label>Numéro Sécurité Social : </label></td>
					<td><label>'.$rep[0]->num_secu.'</label></td>
				</tr>
				<tr>
					<td><label>Login : </label></td>
					<td><label>'.$rep[0]->login.'</label></td>
				</tr>
			</table>';
	}else if(Chiffrement::decrypt($_SESSION['type']) == 'administrateur'){
		echo '<form method="post" action="'.Html::redirection().'mon-profil">
				<table>
					<tr>
						<td><label>Nom : </label></td>
						<td><input type="text" name="nom" value="'.$rep[0]->nom.'"></td>
					</tr>
					<tr>
						<td><label>Prénom : </label></td>
						<td><input type="text" name="prenom" value="'.$rep[0]->prenom.'"></td>
					</tr>
					<tr>
						<td><label>Téléphone : </label></td>
						<td><input type="text" name="tel" value="'.$rep[0]->telephone.'"></td>
					</tr>
					<tr>
						<td><label>E-mail : </label></td>
						<td><input type="text" name="mail" value="'.$rep[0]->mail.'"></td>
					</tr>
					<tr>
						<td><label>Adresse : </label></td>
						<td><input type="text" name="adresse" value="'.$rep[0]->adresse.'"></td>
					</tr>
					<tr>
						<td><label>Mot-de-Passe : </label></td>
						<td><input type="text" name="pass"></td>
					</tr>
					<tr>
						<td><label>Login : </label></td>
						<td><input type="text" name="login" value="'.$rep[0]->login.'"></td>
						<td><input type="submit" name="envoyer" value="Envoyer"></td>
					</tr>
				</table>
			</form>';
	}

}?>
</div>
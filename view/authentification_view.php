<?php
if(empty($_SESSION['connect'])){
?>
	<div class="article">
		<div id="connexion">
			<form method="POST" action="connexion&Inscription">
				<input type="text" name="login"/>
				<input type="text" name="mot_de_passe"/>
				<input type="submit" name="connexion" value="Connexion"/>
			</form>
		</div>
		<div id="inscription">
			<p>Pour se qui est de l'incscription seul l'administrateur peul créer un compte.</p>
		</div>
	</div>
<?php
}
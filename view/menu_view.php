<div id="menu" class="div">
<?php
if(isset($_SESSION['connect'])){
	echo '<ul>';
	if(Chiffrement::decrypt($_SESSION['type']) == "patient"){
		echo '<li><a href="'.Html::redirection().'rendez-vous">Rendez-vous</a></li>';
		echo '<li><a href="'.Html::redirection().'medecin">Médecin</a></li>';
	}
	else if(Chiffrement::decrypt($_SESSION['type']) == "medecin"){
		echo "
			<li><a href='".Html::redirection()."rendez-vous'>Rendez-vous</a></li>
			<li><a href='".Html::redirection()."patient'>Patient</a></li>";
	}
	else if(Chiffrement::decrypt($_SESSION['type']) == "administrateur"){
		echo "
			<li><a href='".Html::redirection()."medecin'>Médecin</a></li>
			<li><a href='".Html::redirection()."patient'>Patient</a></li>";
	}
		echo '
				<li><a href="'.Html::redirection().'deconnect">Deconnexion</a></li>
			</ul>';
}else{
	?>
	<ul>
		<li>Service</li>
		<li>Médecin</li>
		<li><a href="connexion&Inscription">Connexion & Inscritption</a></li>
	</ul>
	<?php
}
?>
</div>
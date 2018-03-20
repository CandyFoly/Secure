<div id="menu">
<?php
if(isset($_SESSION['connect'])){
	echo '<ul>';
	if($_SESSION['type'] == "patient"){}
	else if($_SESSION['type'] == "medecin"){
		echo "
			<li><a href='".Html::redirection()."rendez-vous'>Rendez-vous</a></li>
			<li><a href='".Html::redirection()."patient'>Patient</a></li>";
	}
	else if($_SESSION['type'] == "admin"){}
		echo '
				<li><a href="deconnect">Deconnexion</a></li>
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
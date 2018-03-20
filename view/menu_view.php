<div id="menu">
<?php
if(isset($_SESSION['connect'])){
	if($_SESSION['type'] == "patient"){}
	else if($_SESSION['type'] == "medecin"){}
	else if($_SESSION['type'] == "admin"){}
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
<?php
include('entete_view.php');
?>
<div class="article"><p>
<?php
if(isset($_SESSION['connect'])){
	if($_SESSION['connect'] == 1){
		?>
		<p>Vous êtes bien connecté. Et vous êes de type </p>
		<?php
		echo $_SESSION['type'];
	}
}
?>

Bonjour vous voila sur le site de l'hopital</p></div>
<?php
include('footer_view.php');;
?>
<?php
include('../view/entete_view.php');
$secu = new secure();
//$secu->detecteURLBlanche($_SERVER['SERVER_NAME'], $_SERVER["REQUEST_URI"]);
include('../model/patient_data.php');
include('../view/patient_view.php');
include('../view/footer_view.php');

?>
<?php

$sel = "SELECT utilisateur.id, nom, prenom, telephone, adresse, mTraitant, num_secu, mail FROM utilisateur, type_user, occuper WHERE utilisateur.type =type_user.id AND utilisateur.id = occuper.id_medecin AND id_medecin = :id ";
$bdd = new connexion();
$rep = $bdd->prepareQuery($sel, array(':id' => $_SESSION['id']));
?>
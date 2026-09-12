<?php

include_once "$racine/modele/bd.rencontre.inc.php";

$db = connexionPDO();
$rencontreModel = new RencontreModel($db);
$rencontres = $rencontreModel->getRencontres();

$titre = "Résultats des Matchs";
$style = "rencontres"; 

include "$racine/vue/entete.html.php"; 
include "$racine/vue/vueListeRencontres.php";
include "$racine/vue/pied.html.php";
?>
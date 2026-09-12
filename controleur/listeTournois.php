<?php

include_once "$racine/modele/bd.tournoi.inc.php";

$db = connexionPDO();
$tournoiModel = new TournoiModel($db);
$tournois = $tournoiModel->getTournois();

$titre = "Calendrier des Tournois";
$style = "tournoi"; 

include "$racine/vue/entete.html.php";
include "$racine/vue/vueListeTournois.php"; 
include "$racine/vue/pied.html.php";
?>
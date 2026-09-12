<?php

include_once "$racine/modele/bd.joueur.inc.php";

$db = connexionPDO();
$joueurModel = new JoueurModel($db);
$joueurs = $joueurModel->getAllJoueurs();

$titre = "Liste des joueurs";
$style = "joueurs";

include "$racine/vue/entete.html.php";
include "$racine/vue/vueListeJoueurs.php";
include "$racine/vue/pied.html.php";
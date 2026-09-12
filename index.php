<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "getRacine.php";
include_once "$racine/controleur/controleurPrincipal.php";
include_once "$racine/modele/bd.inc.php";

$db = connexionPDO();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'accueil';
}

$fichier = controleurPrincipal($action);
include "$racine/controleur/$fichier";
?>
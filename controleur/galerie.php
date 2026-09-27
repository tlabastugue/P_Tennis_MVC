<?php

include_once "$racine/modele/bd.galerie.inc.php";

$db = connexionPDO();
$galerieModel = new GalerieModel($db);
$photos = $galerieModel->getPhotos();

$titre = "Galerie Photos";
$style = "galerie";

include "$racine/vue/entete.html.php";
include "$racine/vue/vueGalerie.php";
include "$racine/vue/pied.html.php";
?>
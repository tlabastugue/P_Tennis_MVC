<?php

function controleurPrincipal($action) {
    $lesActions = array();
    
    $lesActions["default"] = "accueil.php"; 
    
    $lesActions["accueil"] = "accueil.php";
    $lesActions["joueurs"] = "listeJoueurs.php";
    $lesActions["rencontres"] = "listeRencontres.php";
    $lesActions["tournois"] = "listeTournois.php";
    $lesActions["detailJoueur"] = "detailsJoueur.php";
    $lesActions["galerie"] = "galerie.php";

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["default"];
    }
}
?>
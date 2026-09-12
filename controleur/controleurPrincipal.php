<?php

function controleurPrincipal($action) {
    $lesActions = array();
    
    // ACTION PAR DÉFAUT : On pointe vers l'accueil maintenant
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
        // Si l'utilisateur tape n'importe quoi dans l'URL, 
        // on le renvoie aussi vers l'accueil
        return $lesActions["default"];
    }
}
?>
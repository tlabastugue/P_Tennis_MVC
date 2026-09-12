<?php
include_once "$racine/modele/bd.joueur.inc.php";

if (!isset($db)) {
    $db = connexionPDO();
}

$joueurModel = new JoueurModel($db);

if (isset($_GET['id'])) {
    $idJoueur = $_GET['id'];
    $leJoueur = $joueurModel->getJoueurById($idJoueur);
    $leStaff = $joueurModel->getStaffByJoueur($idJoueur);
    $lesMarques = $joueurModel->getMarquesByJoueur($idJoueur);

    if ($leJoueur) {
        $titre = "Profil de " . $leJoueur['Prenom_Joueur'] . " " . $leJoueur['Nom_Joueur'];
    }
}

$style = "detailJoueur";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueDetailsJoueur.php";
include "$racine/vue/pied.html.php";
?>
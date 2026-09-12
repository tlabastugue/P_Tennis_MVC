<?php

class JoueurController {
    public function list() {
        // On récupère la connexion PDO
        $db = connexionPDO(); 
        
        // On passe la connexion au modèle
        $model = new JoueurModel($db); 
        $joueurs = $model->getAllJoueurs();

        // On appelle la vue
        global $racine;
        include "$racine/vue/vueListeJoueurs.php"; 
    }
}
?>
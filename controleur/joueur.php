<?php

class JoueurController {
    public function list() {
        $db = connexionPDO(); 
        
        $model = new JoueurModel($db); 
        $joueurs = $model->getAllJoueurs();

        global $racine;
        include "$racine/vue/vueListeJoueurs.php"; 
    }
}
?>
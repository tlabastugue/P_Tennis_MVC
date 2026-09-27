<?php

include_once "bd.inc.php"; 

class RencontreModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getRencontres() {
        $sql = "SELECT r.*, 
                j1.Nom_Joueur as Nom1, 
                j2.Nom_Joueur as Nom2, 
                t.Nom_Tournoi 
                FROM Rencontre r
                INNER JOIN Joueur j1 ON r.Id_Joueur_1 = j1.Id_Joueur
                INNER JOIN Joueur j2 ON r.Id_Joueur_2 = j2.Id_Joueur
                INNER JOIN Tournoi t ON r.Id_Tournoi = t.Id_Tournoi
                ORDER BY r.Id_Rencontre";
        
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
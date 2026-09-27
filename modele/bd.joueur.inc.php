<?php

class JoueurModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllJoueurs() {
        $query = $this->db->query("SELECT * FROM Joueur ORDER BY Numero_Classement ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJoueurById($id) {
        $query = $this->db->prepare("SELECT * FROM Joueur WHERE Id_Joueur = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getStaffByJoueur($id) {
        $query = $this->db->prepare("SELECT * FROM Staff WHERE Id_Joueur = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMarquesByJoueur($id) {
        $sql = "SELECT m.* FROM Marque m 
                JOIN Sponsor s ON m.Id_Marque = s.Id_Marque 
                WHERE s.Id_Joueur = :id
                ORDER BY m.Type_Marque DESC";
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
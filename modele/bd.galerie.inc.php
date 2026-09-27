<?php
include_once "bd.inc.php"; 

class GalerieModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getPhotos() {
        $query = $this->db->prepare("SELECT * FROM Galerie");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<?php

include_once "bd.inc.php";

class TournoiModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTournois() {
        $query = $this->db->prepare("SELECT * FROM Tournoi");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
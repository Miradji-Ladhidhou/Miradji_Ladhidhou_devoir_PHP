<?php
require_once('./config/config.php');
require_once('./models/PdoModel.php');

class TrajetsModel extends PdoModel
{

    public function getAlltrajets()
    {
        $sql = "SELECT 
                t.*, 
                ad.ville AS agence_depart,
                aa.ville AS agence_arrivee
            FROM trajets t
            LEFT JOIN agences ad ON t.id_agences_depart = ad.id_agences
            LEFT JOIN agences aa ON t.id_agences_arrivee = aa.id_agences
            ORDER BY t.date_heure_depart ASC";

        $stmt = $this->setDB()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

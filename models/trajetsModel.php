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

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTrajetsDisponibles()
{
    $pdo = self::getPdo();
    $stmt = $pdo->query("
        SELECT 
            trajets.*, 
            a1.ville AS agence_depart, 
            a2.ville AS agence_arrivee
        FROM trajets
        JOIN agences a1 ON trajets.id_agences_depart = a1.id_agences
        JOIN agences a2 ON trajets.id_agences_arrivee = a2.id_agences
        WHERE trajets.places_disponibles > 0
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}

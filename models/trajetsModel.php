<?php

namespace Models;

require_once('./config/config.php');

use Models\PdoModel;
use PDO;

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

    public function createTrajetPage($data)
    {
        $sql = "INSERT INTO trajets (
                id_users, id_agences_depart, id_agences_arrivee,
                date_heure_depart, date_heure_arrivee,
                places_totales, places_disponibles
            ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            $data['id_users'],
            $data['id_agences_depart'],
            $data['id_agences_arrivee'],
            $data['date_heure_depart'],
            $data['date_heure_arrivee'],
            $data['places_totales'],
            $data['places_disponibles']
        ]);
    }

    public function getTrajetById($id)
    {
        $stmt = $this->getPdo()->prepare("SELECT * FROM trajets WHERE id_trajets = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTrajet($id, $data)
    {
        $sql = "UPDATE trajets SET 
                id_agences_depart = ?, 
                id_agences_arrivee = ?, 
                date_heure_depart = ?, 
                date_heure_arrivee = ?, 
                places_totales = ?, 
                places_disponibles = ? 
            WHERE id_trajets = ?";

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            $data['id_agences_depart'],
            $data['id_agences_arrivee'],
            $data['date_heure_depart'],
            $data['date_heure_arrivee'],
            $data['places_totales'],
            $data['places_disponibles'],
            $id
        ]);
        return $stmt->rowCount();
    }

    public function deleteTrajet($id)
    {
        $stmt = $this->getPdo()->prepare("DELETE FROM trajets WHERE id_trajets = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}

<?php

namespace Models;

require_once('./config/config.php');

use Models\PdoModel;
use PDO;

/**
 * Modèle pour la gestion des trajets.
 */
class TrajetsModel extends PdoModel
{
    /**
     * Récupère tous les trajets avec informations associées.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getAlltrajets(): array
    {
        $sql = "SELECT 
                t.*, 
                ad.ville AS agence_depart,
                aa.ville AS agence_arrivee,
                u.nom, u.prenom, u.email, u.telephone
            FROM trajets t
            LEFT JOIN agences ad ON t.id_agences_depart = ad.id_agences
            LEFT JOIN agences aa ON t.id_agences_arrivee = aa.id_agences
            LEFT JOIN users u ON t.id_users = u.id_users
            ORDER BY t.date_heure_depart ASC";

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les trajets avec places disponibles.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getTrajetsDisponibles(): array
    {
        $sql = "SELECT 
                t.*, 
                a1.ville AS agence_depart, 
                a2.ville AS agence_arrivee,
                u.nom, u.prenom, u.email, u.telephone
            FROM trajets t
            JOIN agences a1 ON t.id_agences_depart = a1.id_agences
            JOIN agences a2 ON t.id_agences_arrivee = a2.id_agences
            JOIN users u ON t.id_users = u.id_users
            WHERE t.places_disponibles > 0
            ORDER BY t.date_heure_depart ASC";

        $stmt = $this->getPdo()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insère un nouveau trajet en base.
     *
     * @param array<string, mixed> $data Données du trajet.
     * @return void
     */
    public function createTrajetPage(array $data): void
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

    /**
     * Récupère un trajet par son ID.
     *
     * @param int $id Identifiant du trajet.
     * @return array<string, mixed>|false
     */
    public function getTrajetById(int $id)
    {
        $stmt = $this->getPdo()->prepare("SELECT * FROM trajets WHERE id_trajets = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Met à jour un trajet.
     *
     * @param int $id Identifiant du trajet.
     * @param array<string, mixed> $data Données à mettre à jour.
     * @return int Nombre de lignes affectées.
     */
    public function updateTrajet(int $id, array $data): int
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

    /**
     * Supprime un trajet.
     *
     * @param int $id Identifiant du trajet.
     * @return int Nombre de lignes supprimées.
     */
    public function deleteTrajet(int $id): int
    {
        $stmt = $this->getPdo()->prepare("DELETE FROM trajets WHERE id_trajets = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}

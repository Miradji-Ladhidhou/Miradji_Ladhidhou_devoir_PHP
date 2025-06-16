<?php

namespace Models;

require_once('./config/config.php');

use Models\PdoModel;
use PDO;

/**
 * Modèle pour la gestion des agences.
 */
class AgencesModel extends PdoModel
{
    /**
     * Récupère toutes les agences triées par ville.
     *
     * @return array<int, array<string, mixed>> Liste des agences sous forme de tableau associatif.
     */
    public function getAllagences(): array
    {
        $sql = "SELECT * FROM agences ORDER BY ville ASC";

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée une nouvelle agence avec une ville donnée.
     *
     * @param string $ville Le nom de la ville de l'agence.
     * @return bool True si la création a réussi, false sinon.
     */
    public function createAgence(string $ville): bool
    {
        $sql = "INSERT INTO agences (ville) VALUES (:ville)";
        $stmt = $this->getPdo()->prepare($sql);

        try {
            $stmt->execute([':ville' => $ville]);
            return true;
        } catch (\PDOException $e) {
            // Log de l'erreur ou gestion spécifique possible ici
            return false;
        }
    }

    /**
     * Supprime une agence par son identifiant.
     *
     * @param int $id Identifiant de l'agence.
     * @return int Nombre de lignes affectées (0 ou 1 normalement).
     */
    public function deleteAgence(int $id): int
    {
        $stmt = $this->getPdo()->prepare("DELETE FROM agences WHERE id_agences = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    /**
     * Récupère une agence par son identifiant.
     *
     * @param int $id Identifiant de l'agence.
     * @return array<string, mixed>|false Données de l'agence ou false si non trouvée.
     */
    public function getAgenceById(int $id)
    {
        $stmt = $this->getPdo()->prepare("SELECT * FROM agences WHERE id_agences = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

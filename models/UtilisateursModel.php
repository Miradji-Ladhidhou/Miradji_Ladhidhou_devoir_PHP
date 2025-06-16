<?php

namespace Models;

require_once('./config/config.php');

use Models\PdoModel;
use PDO;

class UtilisateursModel extends PdoModel
{

    // Récupère tous les utilisateurs triés par prénom
    public function getAllusers()
    {
        $sql = "SELECT 
                u.prenom, 
                u.nom, 
                u.telephone, 
                u.email
            FROM users u
            ORDER BY u.prenom ASC";

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

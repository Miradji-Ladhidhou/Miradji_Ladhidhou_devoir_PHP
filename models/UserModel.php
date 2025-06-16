<?php

namespace Models;

use Models\PdoModel;
use PDO;

class UserModel extends PdoModel
{
    /**
     * Cherche un utilisateur par son email.
     *
     * @param string $email Email de l'utilisateur.
     * @return array<string, mixed>|false Tableau associatif des données utilisateur ou false si non trouvé.
     */
    public static function findUserByEmail(string $email)
    {
        $pdo = self::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère tous les utilisateurs.
     *
     * @return array<int, array<string, mixed>> Liste des utilisateurs.
     */
    public static function getAllusers(): array
    {
        $pdo = self::getPdo();
        $stmt = $pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

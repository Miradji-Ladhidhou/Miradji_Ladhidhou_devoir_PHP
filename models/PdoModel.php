<?php

namespace Models;

require_once('./config/config.php');

use PDO;
use PDOException;

/**
 * Classe abstraite fournissant une instance PDO partagée.
 */
abstract class PdoModel
{
    /**
     * Instance PDO partagée.
     *
     * @var PDO|null
     */
    protected static $pdo;

    /**
     * Retourne une instance PDO unique (singleton).
     *
     * @return PDO Instance PDO connectée à la base de données.
     */
    public static function getPdo(): PDO
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                    DB_USER,
                    DB_PASSWORD,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}

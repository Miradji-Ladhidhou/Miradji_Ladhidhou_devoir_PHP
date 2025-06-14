<?php
namespace Models;

use Models\PdoModel;
use PDO;

class UserModel extends PdoModel
{
    public static function findUserByEmail($email)
    {
        $pdo = self::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

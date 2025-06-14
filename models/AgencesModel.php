<?php
namespace Models;

require_once('./config/config.php');
use Models\PdoModel;
use PDO;

class AgencesModel extends PdoModel
{

    public function getAllagences()
    {
        $sql = "SELECT * FROM agences" .
            " ORDER BY ville ASC";

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

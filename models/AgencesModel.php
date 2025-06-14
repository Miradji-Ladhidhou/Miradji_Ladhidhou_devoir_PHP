<?php
require_once('./config/config.php');
require_once('./models/PdoModel.php');

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

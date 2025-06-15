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

    public function createAgence($ville)
    {
        $sql = "INSERT INTO agences (ville) VALUES (:ville)";
        $stmt = $this->getPdo()->prepare($sql);
        
        try {
            $stmt->execute([':ville' => $ville]);
            return true;
        } catch (\PDOException $e) {
            // Log the error or handle it as needed
            return false;
        }
    }

   public function deleteAgence($id)
    {
        $stmt = $this->getPdo()->prepare("DELETE FROM agences WHERE id_agences = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function getAgenceById($id)
    {
        $stmt = $this->getPdo()->prepare("SELECT * FROM agences WHERE id_agences = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}

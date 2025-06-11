<?php

require_once('./config/config.php');
require_once('./models/PdoModel.php');


class agences extends PdoModel{

    public function getAllagences(){
        $req = "SELECT * FROM trajets";
        $stmt = $this->setDB()->prepare($req);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }
}
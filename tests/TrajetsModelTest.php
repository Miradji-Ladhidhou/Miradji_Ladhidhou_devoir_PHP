<?php

use PHPUnit\Framework\TestCase;
use Models\TrajetsModel;

class TrajetsModelTest extends TestCase
{
    private TrajetsModel $model;

    protected function setUp(): void
    {
        $this->model = new TrajetsModel();
    }

    public function testGetAlltrajetsReturnsArray()
    {
        $result = $this->model->getAlltrajets();
        $this->assertIsArray($result);
    }

    public function testGetTrajetsDisponiblesReturnsArray()
    {
        $result = $this->model->getTrajetsDisponibles();
        $this->assertIsArray($result);
    }


    public function testCreateTrajetPageInsertsData()
    {
        $data = [
            'id_users' => 1,
            'id_agences_depart' => 1,
            'id_agences_arrivee' => 2,
            'date_heure_depart' => '2025-06-15 10:00:00',
            'date_heure_arrivee' => '2025-06-15 12:00:00',
            'places_totales' => 4,
            'places_disponibles' => 4
        ];

        $this->model->createTrajetPage($data);

        $trajets = $this->model->getAlltrajets();
        $found = false;
        foreach ($trajets as $trajet) {
            if (
                $trajet['id_users'] == $data['id_users'] &&
                $trajet['id_agences_depart'] == $data['id_agences_depart'] &&
                $trajet['id_agences_arrivee'] == $data['id_agences_arrivee'] &&
                $trajet['date_heure_depart'] == $data['date_heure_depart']
            ) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found, "Le trajet inséré doit être retrouvé dans la liste");
    }
}

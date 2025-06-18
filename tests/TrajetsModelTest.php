<?php

use Models\TrajetsModel;

class TrajetsModelTest extends \PHPUnit\Framework\TestCase
{
    private TrajetsModel $trajetsModel;
    private int $lastInsertedId;

    protected function setUp(): void
    {
        $this->trajetsModel = new TrajetsModel();
    }

    public function testCreateAndGetTrajet(): void
    {
        // Données tests 
        $data = [
            'id_users' => 1,
            'id_agences_depart' => 1,
            'id_agences_arrivee' => 2,
            'date_heure_depart' => '2025-06-18 08:00:00',
            'date_heure_arrivee' => '2025-06-18 10:00:00',
            'places_totales' => 4,
            'places_disponibles' => 4
        ];

        $this->trajetsModel->createTrajetPage($data);

        // Récupérer le dernier id inséré
        $pdo = $this->trajetsModel::getPdo();
        $this->lastInsertedId = (int)$pdo->lastInsertId();

        $this->assertIsInt($this->lastInsertedId);
        $this->assertGreaterThan(0, $this->lastInsertedId);

        $trajet = $this->trajetsModel->getTrajetById($this->lastInsertedId);

        $this->assertNotFalse($trajet);
        $this->assertEquals($data['id_users'], $trajet['id_users']);
        $this->assertEquals($data['id_agences_depart'], $trajet['id_agences_depart']);
    }

    public function testUpdateTrajet(): void
    {
        // On crée un trajet test
        $data = [
            'id_users' => 1,
            'id_agences_depart' => 1,
            'id_agences_arrivee' => 2,
            'date_heure_depart' => '2025-06-18 08:00:00',
            'date_heure_arrivee' => '2025-06-18 10:00:00',
            'places_totales' => 4,
            'places_disponibles' => 4
        ];
        $this->trajetsModel->createTrajetPage($data);
        $pdo = $this->trajetsModel::getPdo();
        $lastId = (int)$pdo->lastInsertId();

        // Update
        $updateData = [
            'id_agences_depart' => 2,
            'id_agences_arrivee' => 1,
            'date_heure_depart' => '2025-06-18 09:00:00',
            'date_heure_arrivee' => '2025-06-18 11:00:00',
            'places_totales' => 3,
            'places_disponibles' => 3
        ];

        $affectedRows = $this->trajetsModel->updateTrajet($lastId, $updateData);
        $this->assertEquals(1, $affectedRows);

        $trajet = $this->trajetsModel->getTrajetById($lastId);
        $this->assertEquals($updateData['id_agences_depart'], $trajet['id_agences_depart']);
    }

    public function testDeleteTrajet(): void
    {
        $data = [
            'id_users' => 1,
            'id_agences_depart' => 1,
            'id_agences_arrivee' => 2,
            'date_heure_depart' => '2025-06-18 08:00:00',
            'date_heure_arrivee' => '2025-06-18 10:00:00',
            'places_totales' => 4,
            'places_disponibles' => 4
        ];
        $this->trajetsModel->createTrajetPage($data);
        $pdo = $this->trajetsModel::getPdo();
        $lastId = (int)$pdo->lastInsertId();

        $deletedRows = $this->trajetsModel->deleteTrajet($lastId);
        $this->assertEquals(1, $deletedRows);

        $trajet = $this->trajetsModel->getTrajetById($lastId);
        $this->assertFalse($trajet);
    }
}

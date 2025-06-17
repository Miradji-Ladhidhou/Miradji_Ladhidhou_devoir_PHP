<?php

use Models\AgencesModel;

class AgencesModelTest extends \PHPUnit\Framework\TestCase
{
    private AgencesModel $model;
    private ?int $testAgenceId = null;

    protected function setUp(): void
    {
        $this->model = new AgencesModel();
    }

    protected function tearDown(): void
    {
        if ($this->testAgenceId !== null) {
            // Supprimer uniquement l'agence créée pour le test
            $this->model->deleteAgence($this->testAgenceId);
        }
    }

    public function testCreateAndDeleteAgence(): void
    {
        // Créer une agence test
        $ville = 'TestVille_' . uniqid();
        $result = $this->model->createAgence($ville);
        $this->assertTrue($result);

        // Récupérer l'agence nouvellement créée
        $agences = $this->model->getAllagences();
        $testAgence = null;
        foreach ($agences as $agence) {
            if ($agence['ville'] === $ville) {
                $testAgence = $agence;
                break;
            }
        }
        $this->assertNotNull($testAgence);

        $this->testAgenceId = $testAgence['id_agences'];

        // Tester la suppression de cette agence spécifique
        $deletedCount = $this->model->deleteAgence($this->testAgenceId);
        $this->assertEquals(1, $deletedCount);

        // Après suppression, vérifier que l'agence n'existe plus
        $deletedAgence = $this->model->getAgenceById($this->testAgenceId);
        $this->assertFalse($deletedAgence);

        $this->testAgenceId = null;
    }
}

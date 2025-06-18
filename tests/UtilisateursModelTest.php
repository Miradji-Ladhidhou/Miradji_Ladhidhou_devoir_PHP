<?php

use Models\UtilisateursModel;
use PHPUnit\Framework\TestCase;

class UtilisateursModelTest extends TestCase
{
    private $model;

    protected function setUp(): void
    {
        $this->model = new UtilisateursModel();
    }

    public function testGetAllusersReturnsArray(): void
    {
        $result = $this->model->getAllusers();

        // On s'attend à un tableau
        $this->assertIsArray($result);

        // Chaque élément doit être un tableau associatif avec les clés attendues
        if (count($result) > 0) {
            $this->assertArrayHasKey('prenom', $result[0]);
            $this->assertArrayHasKey('nom', $result[0]);
            $this->assertArrayHasKey('telephone', $result[0]);
            $this->assertArrayHasKey('email', $result[0]);
        }
    }
}

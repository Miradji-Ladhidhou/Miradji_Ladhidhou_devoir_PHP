<?php

use PHPUnit\Framework\TestCase;
use Models\PdoModel;

class PdoModelTest extends TestCase
{
    /**
     * Teste que la méthode getPdo retourne bien une instance de PDO
     */
    public function testGetPdoReturnsPdoInstance()
    {
        $pdo = PdoModel::getPdo();
        $this->assertInstanceOf(PDO::class, $pdo, "La méthode getPdo doit retourner une instance de PDO");
    }
}

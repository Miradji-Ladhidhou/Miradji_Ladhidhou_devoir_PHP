<?php

use Models\PdoModel;
use PDO;

class PdoModelTest extends \PHPUnit\Framework\TestCase
{
    public function testGetPdoReturnsPdoInstance(): void
    {
        $testClass = new class extends PdoModel {};

        $pdo1 = $testClass::getPdo();
        $this->assertInstanceOf(PDO::class, $pdo1);

        $pdo2 = $testClass::getPdo();
        $this->assertSame($pdo1, $pdo2, 'getPdo() should return the same PDO instance (singleton)');
    }
}

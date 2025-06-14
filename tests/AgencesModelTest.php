<?php

use PHPUnit\Framework\TestCase;
use Models\AgencesModel;


class AgencesModelTest extends TestCase
{
    public function testGetAllAgencesReturnsArray()
    {
        $model = new AgencesModel();
        $result = $model->getAllagences();

        $this->assertIsArray($result);
    }
}

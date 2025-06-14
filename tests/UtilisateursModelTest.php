<?php

use PHPUnit\Framework\TestCase;
use Models\UtilisateursModel;

class UtilisateursModelTest extends TestCase
{
    private UtilisateursModel $model;

    protected function setUp(): void
    {
        $this->model = new UtilisateursModel();
    }

    public function testGetAllUsersReturnsArray()
    {
        $users = $this->model->getAllusers();

        $this->assertIsArray($users);
        if (!empty($users)) {
            $this->assertArrayHasKey('prenom', $users[0]);
            $this->assertArrayHasKey('nom', $users[0]);
            $this->assertArrayHasKey('telephone', $users[0]);
            $this->assertArrayHasKey('email', $users[0]);
        }
    }
}

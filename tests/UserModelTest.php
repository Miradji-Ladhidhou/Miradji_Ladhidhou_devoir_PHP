<?php

use PHPUnit\Framework\TestCase;
use Models\UserModel;

class UserModelTest extends TestCase
{
    private UserModel $model;

    protected function setUp(): void
    {
        $this->model = new UserModel();
    }

    public function testFindUserByEmailReturnsUserArray()
    {
        $email = 'clara.chevalier@email.fr';

        $user = $this->model->findUserByEmail($email);

        $this->assertIsArray($user);
        $this->assertArrayHasKey('email', $user);
        $this->assertEquals($email, $user['email']);
    }

    public function testFindUserByEmailReturnsFalseForUnknownEmail()
{
    $result = UserModel::findUserByEmail('email_qui_n_existe_pas@example.com');
    $this->assertFalse($result);
}

}

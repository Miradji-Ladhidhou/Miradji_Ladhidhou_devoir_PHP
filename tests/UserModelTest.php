<?php

use Models\UserModel;

class UserModelTest extends \PHPUnit\Framework\TestCase
{
    private UserModel $userModel;

    protected function setUp(): void
    {
        $this->userModel = new UserModel();
    }

    public function testFindUserByEmailReturnsUser(): void
    {
        $email = 'camille.moreau@email.fr';

        $user = $this->userModel::findUserByEmail($email);

        $this->assertIsArray($user);
        $this->assertEquals($email, $user['email']);
    }

    public function testFindUserByEmailReturnsFalseForUnknownEmail(): void
    {
        $email = 'inconnu@domain.com';

        $user = $this->userModel::findUserByEmail($email);

        $this->assertFalse($user);
    }

    public function testGetAllUsersReturnsArray(): void
    {
        $users = $this->userModel::getAllusers();

        $this->assertIsArray($users);
        if (!empty($users)) {
            $this->assertIsArray($users[0]);
            $this->assertArrayHasKey('email', $users[0]);
        }
    }
}

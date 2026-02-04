<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation()
    {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
    }

    public function testUserDefaultRole()
    {
        $user = new User();
        $this->assertEquals(['ROLE_USER'], $user->getRoles());
    }

    public function testSetAndGetUsername()
    {
        $user = new User();
        $username = 'testuser';
        
        $user->setUsername($username);
        $this->assertEquals($username, $user->getUsername());
    }

    public function testSetAndGetPlainPassword()
    {
        $user = new User();
        $password = 'testpassword123';
        
        $user->setPlainPassword($password);
        $this->assertEquals($password, $user->getPlainPassword());
        $this->assertEquals($password, $user->getPassword());
    }

    public function testSetAndGetRoles()
    {
        $user = new User();
        $roles = ['ROLE_USER', 'ROLE_ADMIN'];
        
        $user->setRoles($roles);
        $this->assertEquals($roles, $user->getRoles());
    }

    public function testGetSaltReturnsNull()
    {
        $user = new User();
        $this->assertNull($user->getSalt());
    }

    public function testSetAndGetDislikes()
    {
        $user = new User();
        $dislikes = [];
        
        $user->setDislikes($dislikes);
        $this->assertEquals($dislikes, $user->getDislikes());
    }

    public function testSetAndGetComments()
    {
        $user = new User();
        $comments = [];
        
        $user->setComments($comments);
        $this->assertEquals($comments, $user->getComments());
    }

    public function testSetAndGetEntries()
    {
        $user = new User();
        $entries = [];
        
        $user->setEntries($entries);
        $this->assertEquals($entries, $user->getEntries());
    }
}

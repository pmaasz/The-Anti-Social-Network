<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testRegisterPageLoads()
    {
        $crawler = $this->client->request('GET', '/register');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
    }

    public function testLoginPageLoads()
    {
        $crawler = $this->client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
    }

    public function testForgotPasswordPageLoads()
    {
        $crawler = $this->client->request('GET', '/password');
        $this->assertResponseIsSuccessful();
    }

    public function testUserProfilePageLoads()
    {
        $crawler = $this->client->request('GET', '/user');
        $this->assertResponseIsSuccessful();
    }
}

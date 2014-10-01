<?php

namespace ReverseAuction\WebservicesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserLoginControllerTest extends WebTestCase
{
    public function testUserlogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/UserLogin');
    }

}

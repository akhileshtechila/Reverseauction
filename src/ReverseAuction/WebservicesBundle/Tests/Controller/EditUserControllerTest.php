<?php

namespace ReverseAuction\WebservicesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EditUserControllerTest extends WebTestCase
{
    public function testEdituser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/EditUser');
    }

}

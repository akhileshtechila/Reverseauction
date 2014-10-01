<?php

namespace ReverseAuction\WebservicesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductInformationControllerTest extends WebTestCase
{
    public function testProductinformation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ProductInformation');
    }

}

<?php

namespace ReverseAuction\WebservicesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplyBidsControllerTest extends WebTestCase
{
    public function testApplybids()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ApplyBids');
    }

}

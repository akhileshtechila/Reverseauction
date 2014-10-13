<?php

namespace ReverseAuction\WebservicesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BidWinnersControllerTest extends WebTestCase
{
    public function testBidswinners()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/BidsWinners');
    }

}

<?php

namespace ReverseAuction\ReverseAuctionBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegistration()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Registration');
    }

}

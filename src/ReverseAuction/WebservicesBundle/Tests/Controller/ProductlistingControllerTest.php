<?php

namespace ReverseAuction\WebservicesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductListingControllerTest extends WebTestCase
{
    public function testProductlisting()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ProductListing');
    }

}

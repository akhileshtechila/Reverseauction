<?php

namespace ReverseAuction\WebservicesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ForgetPasswordControllerTest extends WebTestCase
{
    public function testForgetpassword()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ForgetPassword');
    }

}

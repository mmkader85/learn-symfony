<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/site/');

        static::assertEquals(200, $client->getResponse()->getStatusCode());
        static::assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
}

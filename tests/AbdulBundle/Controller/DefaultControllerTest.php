<?php

namespace AbdulBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/abdul/');

        static::assertContains('Hello World', $client->getResponse()->getContent());
    }
}

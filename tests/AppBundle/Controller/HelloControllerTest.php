<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloControllerTest extends WebTestCase
{
    public function testRedirect()
    {
        $client = self::createClient();
        $client->request('GET', '/site/redirect');

        static::assertTrue($client->getResponse()->isRedirect());

        static::assertTrue($client->getResponse()->isRedirect('/site/random/number'));
    }
}
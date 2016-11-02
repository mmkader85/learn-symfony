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
        static::assertGreaterThan(
            0,
            $crawler->filter('html:contains("Hello World")')->count()
        );

        static::assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'text/html; charset=UTF-8'),
            'the "Content-Type" header is "text/html; charset=UTF-8"' // optional message shown on failure
        );

        static::assertRegExp('/Click to see product [0-9]+/', $client->getResponse()->getContent(), 'No anchor link to product');

        // Assert that the response status code is 2xx
        static::assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');

        // Assert a specific 200 status code
        static::assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

        $productLink = $crawler->filter('a#productLink')->eq(0)->link();
        $client->click($productLink);

        static::assertRegExp('/Id: 2/', $client->getResponse()->getContent());
    }

    public function test404Page()
    {
        $client = self::createClient();
        $client->request('GET', '/page-does-not-exist');

        static::assertTrue($client->getResponse()->isNotFound());

    }
}

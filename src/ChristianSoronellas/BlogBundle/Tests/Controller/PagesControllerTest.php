<?php

namespace ChristianSoronellas\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PagesControllerTest extends WebTestCase
{
    /**
     * Test for the RSS feed generation
     */
    public function testRssFeedGeneration()
    {
        $client = static::createClient();

        $client->request('GET', '/feed.rss');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('application/rss+xml', $client->getResponse()->headers->get('content-type'));
    }
}
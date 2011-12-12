<?php

namespace ChristianSoronellas\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TagsControllerTest extends WebTestCase
{
    /**
     * There has to be allways at least one post
     */
    public function testContact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tag/test-tag1');

        $this->assertEquals(1, $crawler->filter('h3.tag-title')->count());
        $this->assertTrue($crawler->filter('div.post')->count() > 0);
    }
}
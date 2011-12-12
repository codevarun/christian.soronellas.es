<?php

namespace ChristianSoronellas\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PagesControllerTest extends WebTestCase
{
    /**
     * There has to be allways at least one link to the contact page
     */
    public function testPages()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('#nav li')->count() >= 1);
    }
    
    /**
     * Tests the contents of a page
     */
    public function testPage()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/pages/me');
        
        $this->assertEquals(1, $crawler->filter('#content:contains("Me")')->count());
    }
}
<?php

namespace ChristianSoronellas\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    /**
     * Test that the contact page shows an iframe to contactme.com
     */
    public function testContact()
    {
        $client = static::createClient();

        $client->request('GET', '/contact');
        $crawler = $client->followRedirect();
        
        $this->assertEquals(1, $crawler->filter('iframe')->count());
    }
}
<?php

namespace ChristianSoronellas\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Faker\Factory as FakerFactory;

class ContactControllerTest extends WebTestCase
{
    /**
     * Test that messages can be sent
     */
    public function testContact()
    {
        $client = static::createClient();
        $faker = FakerFactory::create();

        $client->followRedirects();

        $crawler = $client->request('GET', '/contact');
        $form = $crawler->selectButton('Send!')->form(array(
            'christiansoronellas_blogbundle_contacttype[name]' => $faker->name,
            'christiansoronellas_blogbundle_contacttype[email]' => $faker->email,
            'christiansoronellas_blogbundle_contacttype[body]' => $faker->text
        ));
        $crawler = $client->submit($form);

        $this->assertCount(1, $crawler->filter('.alert.alert-success'));
    }
}
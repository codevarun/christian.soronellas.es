<?php

namespace ChristianSoronellas\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Faker\Factory as FakerFactory;

class PostsControllerTest extends WebTestCase
{
    /**
     * There has to be allways at least one post
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(0, $crawler->filter('.post')->count());
    }
    
    /**
     * Test that post page renders successfully
     */
    public function testPost()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/2011/12/09/test1');
        
        $this->assertCount(1, $crawler->filter('.post'));
        $this->assertCount(1, $crawler->filter('.comments'));
    }
    
    /**
     * Test that post comments are saved successfully
     */
    public function testCommentsAreSavedSuccessfully()
    {
        $client = static::createClient();
        $faker = FakerFactory::create();

        $client->followRedirects();
        $crawler = $client->request('GET', '/2011/12/09/test1');
        
        $form = $crawler->selectButton('Comment')->form(array(
            'christiansoronellas_blogbundle_commenttype[name]'  => $faker->name,
            'christiansoronellas_blogbundle_commenttype[email]' => $faker->email,
            'christiansoronellas_blogbundle_commenttype[body]'  => $faker->text
        ));
        $crawler = $client->submit($form);
        
        $this->assertCount(1, $crawler->filter('.alert.alert-success'));
        $this->assertCount(1, $crawler->filter('.alert.alert-success:contains("Your comment has been saved succesfully!")'));
    }
}
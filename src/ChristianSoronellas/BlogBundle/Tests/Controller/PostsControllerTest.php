<?php

namespace ChristianSoronellas\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostsControllerTest extends WebTestCase
{
    /**
     * There has to be allways at least one post
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('div.post')->count() > 0);
    }
    
    /**
     * Test that post page renders successfully
     */
    public function testPost()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/2011/12/09/test1');
        
        $this->assertEquals(1, $crawler->filter('div.post')->count(), 'There isn\'t a "post" layer!!');
        $this->assertEquals(1, $crawler->filter('.post-meta')->count(), 'There isn\'t a "post-meta" layer!!');
        $this->assertTrue($crawler->filter('.comment')->count() > 0);
        $this->assertEquals(1, $crawler->filter('#respond')->count());
    }
    
    /**
     * Test that comments form cannot be sent with empty values
     */
    public function testCommentsFormCannotBeSentEmpty()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/2011/12/09/test1');
        
        $form = $crawler->selectButton('submit')->form();
        $crawler = $client->submit($form);
        
        $this->assertTrue($crawler->filter('html:contains("This value should not be blank")')->count() > 0);
    }
    
    /**
     * Test that the email field on the comments form only accepts valid email
     * addresses.
     */
    public function testCommentsFormEmailFieldOnlyAcceptsValidEmailAddesses()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/2011/12/09/test1');
        
        $form = $crawler->selectButton('submit')->form(array(
            'christiansoronellas_blogbundle_commenttype[email]' => 'test'
        ));
        $crawler = $client->submit($form);
        
        $this->assertTrue($crawler->filter('html:contains("This value is not a valid email address")')->count() > 0);
    }
    
    /**
     * Test that post comments are saved successfully
     */
    public function testCommentsAreSavedSuccessfully()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/2011/12/09/test1');
        
        $form = $crawler->selectButton('submit')->form(array(
            'christiansoronellas_blogbundle_commenttype[name]'  => 'Test',
            'christiansoronellas_blogbundle_commenttype[email]' => 'test@test.com',
            'christiansoronellas_blogbundle_commenttype[body]'  => 'Test body!'
        ));
        $client->submit($form);
        
        $crawler = $client->followRedirect();
        
        $this->assertEquals(1, $crawler->filter('div.flash-notice')->count());
        $this->assertTrue($crawler->filter('div.flash-notice:contains("Your comment is awaiting moderation!")')->count() > 0);
    }
}
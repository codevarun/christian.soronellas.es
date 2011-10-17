<?php

// src/Acme/HelloBundle/DataFixtures/ORM/LoadPostsData.php
namespace ChristianSoronellas\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use ChristianSoronellas\BlogBundle\Entity\Post;

class LoadPostsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $post = new Post();
        $post->setTitle('Test1');
        $post->setBody('TestBody1');
        $post->setCreatedAt(new \DateTime());
        $post->setUpdatedAt(new \DateTime());
        
        $manager->persist($post);
        $manager->flush();
        
        $this->addReference('post1', $post);
        
        sleep(1);
        
        $post = new Post();
        $post->setTitle('Test2');
        $post->setBody('TestBody2');
        $post->setCreatedAt(new \DateTime());
        $post->setUpdatedAt(new \DateTime());

        $manager->persist($post);
        $manager->flush();
        
        $this->addReference('post2', $post);
    }
    
    public function getOrder()
    {
        return 1;
    }
}
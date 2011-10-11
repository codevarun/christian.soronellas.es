<?php

// src/Acme/HelloBundle/DataFixtures/ORM/LoadPostsData.php
namespace Acme\HelloBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use ChristianSoronellas\BlogBundle\Entity\Post;

class LoadPostsData implements FixtureInterface
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
        
        sleep(1);
        
        $post = new Post();
        $post->setTitle('Test2');
        $post->setBody('TestBody2');
        $post->setCreatedAt(new \DateTime());
        $post->setUpdatedAt(new \DateTime());

        $manager->persist($post);
        $manager->flush();
    }
}
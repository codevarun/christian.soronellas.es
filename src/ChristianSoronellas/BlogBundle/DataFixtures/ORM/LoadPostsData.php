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
        $tag1 = $manager->merge($this->getReference('tag1'));
        $tag2 = $manager->merge($this->getReference('tag2'));
        
        $post = new Post();
        $post->setTitle('Test1');
        $post->setBody('TestBody1');
        $post->setCreatedAt(new \DateTime());
        $post->setUpdatedAt(new \DateTime());
        $post->addTag($tag1);
        $post->addTag($tag2);
        
        $tag1->addPost($post);
        $tag2->addPost($post);
        
        $manager->persist($post);
        $manager->persist($tag1);
        $manager->persist($tag2);
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
        return 2;
    }
}
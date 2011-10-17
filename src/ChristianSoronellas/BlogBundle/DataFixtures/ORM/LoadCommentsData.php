<?php

// src/Acme/HelloBundle/DataFixtures/ORM/LoadCommentsData.php
namespace ChristianSoronellas\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use ChristianSoronellas\BlogBundle\Entity\Comment;

class LoadCommentsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $comment = new ChristianSoronellas\BlogBundle\Entity\Comment();
        $comment->setBody('TestComment1');
        $comment->setEmail('theunic@gmail.com');
        $comment->setName('TestAuthor1');
        $post = $manager->merge($this->getReference('post1'));
        $comment->setPost($post);
        $post->addComment($comment);
        
        $manager->persist($comment);
        $manager->persist($post);
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 2;
    }
}
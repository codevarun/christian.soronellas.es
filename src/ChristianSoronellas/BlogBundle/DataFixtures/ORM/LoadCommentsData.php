<?php

// src/Acme/HelloBundle/DataFixtures/ORM/LoadCommentsData.php
namespace ChristianSoronellas\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use ChristianSoronellas\BlogBundle\Entity\Comment;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCommentsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Load target post
        $post = $manager->merge($this->getReference('post1'));
        
        // First comment - create & persist
        $comment1 = new Comment();
        $comment1->setBody('TestComment1');
        $comment1->setEmail('theunic@gmail.com');
        $comment1->setName('TestAuthor1');
        $comment1->setState(Comment::STATE_APPROVED);
        $comment1->setPost($post);
        $post->addComment($comment1);
        
        $manager->persist($comment1);
        $manager->persist($post);
        $manager->flush();
        
        sleep(1);
        
        $comment2 = new Comment();
        $comment2->setBody('TestComment2');
        $comment2->setEmail('theunic@gmail.com');
        $comment2->setName('TestAuthor2');
        $comment2->setState(Comment::STATE_APPROVED);
        $comment2->setPost($post);
        $post->addComment($comment2);
        
        $manager->persist($comment2);
        $manager->persist($post);
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 3;
    }
}
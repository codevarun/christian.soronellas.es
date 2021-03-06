<?php

// src/Acme/HelloBundle/DataFixtures/ORM/LoadPostsData.php
namespace ChristianSoronellas\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use ChristianSoronellas\BlogBundle\Entity\Post;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPostsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tag1 = $manager->merge($this->getReference('tag1'));
        $tag2 = $manager->merge($this->getReference('tag2'));

        $post = new Post();
        $post->setTitle('Test1');
        $post->setBody('<p>TestBody1</p>');
        $post->setCreatedAt(new \DateTime('2011-12-09'));
        $post->setUpdatedAt(new \DateTime('2011-12-09'));
        $post->setState(Post::STATE_COMPLETE);
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
        $post->setBody('<p>TestBody2</p>');
        $post->setCreatedAt(new \DateTime('2011-12-09'));
        $post->setUpdatedAt(new \DateTime('2011-12-09'));
        $post->setState(Post::STATE_COMPLETE);

        $manager->persist($post);
        $manager->flush();

        $this->addReference('post2', $post);

        $post = new Post();
        $post->setTitle('Test3');
        $post->setBody('<p>TestBody3</p>');
        $post->setCreatedAt(new \DateTime());
        $post->setUpdatedAt(new \DateTime());
        $post->setState(Post::STATE_COMPLETE);
        $post->setCommentsEnabled(false);

        $manager->persist($post);
        $manager->flush();

        $this->addReference('post3', $post);
    }

    public function getOrder()
    {
        return 2;
    }
}
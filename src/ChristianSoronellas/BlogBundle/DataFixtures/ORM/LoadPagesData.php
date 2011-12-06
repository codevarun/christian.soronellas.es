<?php

// src/Acme/HelloBundle/DataFixtures/ORM/LoadPagesData.php
namespace ChristianSoronellas\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use ChristianSoronellas\BlogBundle\Entity\Page;

class LoadPagesData extends AbstractFixture
{
    public function load($manager)
    {   
        $page = new Page();
        $page->setTitle('Me');
        $page->setBody('My body!');
        $page->setCreatedAt(new \DateTime());
        $page->setUpdatedAt(new \DateTime());
        
        $manager->persist($page);
        $manager->flush();
    }
}
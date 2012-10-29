<?php

namespace ChristianSoronellas\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use ChristianSoronellas\BlogBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Tag entity
 *
 * @author csoronellas
 */
class LoadTagsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tag1 = new Tag();
        $tag1->setTag('test tag1');
        
        $manager->persist($tag1);
        $manager->flush();
        $this->setReference('tag1', $tag1);
        
        $tag2 = new Tag();
        $tag2->setTag('test tag2');
        
        $manager->persist($tag2);
        $manager->flush();
        $this->setReference('tag2', $tag2);
    }
    
    public function getOrder()
    {
        return 1;
    }
}
<?php

namespace ChristianSoronellas\BlogBundle\Feed\Importer;

use ChristianSoronellas\BlogBUndle\Feed\Importer;
use Doctrine\ORM\EntityManager;

/**
 * The abstract Doctrine feed importer
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
abstract class DoctrineImporter implements Importer
{
    /**
     * The Doctrine2 entity manager
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Class constructor. Depends on Doctrine2 Entity Manager
     *
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }
}
<?php

namespace ChristianSoronellas\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use ChristianSoronellas\BlogBundle\Entity\Post;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends EntityRepository
{
    /**
     * Find all posts published ordered by date
     *
     * @return \ChristianSoronellas\BlogBundle\Entity\Post[]
     */
    public function findPublishedOrderedByCreatedAt()
    {
        $q = $this->getEntityManager()->createQuery(
            'SELECT p
             FROM ChristianSoronellasBlogBundle:Post p
             WHERE p.state = 2
             ORDER BY p.created_at DESC'
        );

        return $q->getResult();
    }
}
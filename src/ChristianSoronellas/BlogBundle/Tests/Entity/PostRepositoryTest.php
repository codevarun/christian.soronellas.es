<?php

namespace ChristianSoronellas\BlogBundle\Tests\Entity;

use Mockery;
use PHPUnit_Framework_TestCase;

class PostRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \ChristianSoronellas\BlogBundle\Entity\PostRepository
     */
    protected $object;

    /**
     * @var Mockery\Mock
     */
    protected $em;

    /**
     * @var Mockery\Mock
     */
    protected $classMetadata;

    public function setUp()
    {
        $this->em = Mockery::mock('\Doctrine\ORM\EntityManager');
        $this->classMetadata = Mockery::mock('\Doctrine\ORM\Mapping\ClassMetadata');
        $this->object = new \ChristianSoronellas\BlogBundle\Entity\PostRepository($this->em, $this->classMetadata);
    }

    public function tearDown()
    {
        $this->em = $this->classMetadata = $this->object = null;
    }

    public function testFindPublishedOrderedByCreatedAt()
    {
        $query = Mockery::mock(new \Doctrine\ORM\Query($this->em));
        $query->shouldReceive('getResult')->once()->andReturn('#result#');

        $this->em->shouldReceive('createQuery')->once()->with(
            'SELECT p
             FROM ChristianSoronellasBlogBundle:Post p
             WHERE p.state = 2
             ORDER BY p.created_at DESC'
        )->andReturn($query);

        $this->assertEquals('#result#', $this->object->findPublishedOrderedByCreatedAt());
    }
}
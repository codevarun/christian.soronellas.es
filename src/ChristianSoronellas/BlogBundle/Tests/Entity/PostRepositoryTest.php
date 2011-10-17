<?php

namespace ChristianSoronellas\BlogBundle\Tests\Entity;

use ChristianSoronellas\BlogBundle\Entity\PostRepository;
use ChristianSoronellas\BlogBundle\Entity\Post;

/**
 * A test suite for the posts repository
 *
 * @author Christian Soronellas <theunic@gmail.com>
 */
class PostRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The post repository
     * 
     * @var ChristianSoronellas\BlogBundle\Entity\PostRepository
     */
    protected $_postRepository;
    
    public function setUp()
    {
        $this->_postRepository = new PostRepository();
    }
    
    public function tearDown()
    {
        $this->_postRepository = null;
    }
    
    public function testFindBySlug()
    {
        
    }
}
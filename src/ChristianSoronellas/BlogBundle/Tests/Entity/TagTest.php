<?php

namespace ChristianSoronellas\BlogBundle\Tests\Entity;

use ChristianSoronellas\BlogBundle\Entity\Post;
use ChristianSoronellas\BlogBundle\Entity\Tag;

/**
 * A test suite for the Tag entity
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class TagTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The Tag entity
     * 
     * @var ChristianSoronellas\BlogBundle\Entity\Tag
     */
    private $_tag;
    
    protected function setUp()
    {
        $this->_tag = new Tag();
    }
    
    protected function tearDown()
    {
        $this->_tag = null;
    }
    
    public function testTagWhenEchoedPrintsTag()
    {
        $this->_tag->setTag('test');
        $this->assertEquals('test', "{$this->_tag}");
    }
}
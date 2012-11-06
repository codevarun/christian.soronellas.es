<?php

namespace ChristianSoronellas\BlogBundle\Tests\Entity;

use ChristianSoronellas\BlogBundle\Entity\Comment;

/**
 * A test suite for the Comment entity
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class CommentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The Post entity
     * 
     * @var \ChristianSoronellas\BlogBundle\Entity\Comment
     */
    private $_comment;
    
    /**
     * Set up the fixture
     */
    protected function setUp()
    {
        $this->_comment = new Comment();
    }
    
    /**
     * Tear down the fixture
     */
    protected function tearDown()
    {
        $this->_comment = null;
    }
    
    public function testBeforeSave()
    {
        $this->_comment->beforeSave();

        $this->assertEquals(Comment::STATE_AWAITING_MODERATION, $this->_comment->getState());
    }
}
<?php

namespace ChristianSoronellas\BlogBundle\Tests\Entity;

use ChristianSoronellas\BlogBundle\Entity\Post;
use ChristianSoronellas\BlogBundle\Entity\Comment;

/**
 * A test suite for the Post entity
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class PostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The Post entity
     * 
     * @var ChristianSoronellas\BlogBundle\Entity\Post
     */
    private $_post;
    
    /**
     * Set up the fixture
     */
    protected function setUp()
    {
        $this->_post = new Post();
    }
    
    /**
     * Tear down the fixture
     */
    protected function tearDown()
    {
        $this->_post = null;
    }
    
    /**
     * Tests that post can return only approved comments
     */
    public function testGetApprovedOnlyPostComments()
    {
        // Prepare the comments
        // Approved comment
        $approvedComment = new Comment();
        $approvedComment->setBody('Approved comment!');
        $approvedComment->setState(Comment::STATE_APPROVED);
        $this->_post->addComment($approvedComment);
        
        // Refused comment
        $refusedComment = new Comment();
        $refusedComment->setBody('Refused comment!');
        $refusedComment->setState(Comment::STATE_REFUSED);
        $this->_post->addComment($refusedComment);
        
        $this->assertEquals(1, sizeof($this->_post->getApprovedComments()));
    }
}
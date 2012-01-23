<?php

namespace ChristianSoronellas\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManager;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ChristianSoronellas\BlogBundle\Entity\Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="ChristianSoronellas\BlogBundle\Entity\PostRepository")
 */
class Post extends Content
{
    const STATE_DRAFT = 1;
    const STATE_COMPLETE = 2;
    
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var \Doctrine\Commons\Collections\ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    private $comments;
    
    /**
     * The post tags
     * 
     * @var \Doctrine\Commons\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts")
     * @ORM\JoinTable(name="posts_tags")
     */
    private $tags;
    
    /**
     * Whether users can post comments.
     * 
     * @var boolean
     * @ORM\Column(name="comments_enabled", type="boolean")
     */
    private $commentsEnabled = true;
    
    /**
     * The post state
     * @var int
     * @ORM\Column(name="state", type="integer")
     */
    private $state = self::STATE_DRAFT;
    
    /**
     * Genrates a feed
     */
    private function _generateFeed(EntityManager $em)
    {
        $em->getRepository('ChristianSoronellasBlogBundle:Post')
           ->generateFeed();
    }
    
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
    
    /**
     * Returns the approved post comments
     * 
     * @return array
     */
    public function getApprovedComments()
    {
        $comments = $this->getComments();
        
        if (!is_array($comments)) {
            $comments = $comments->toArray();
        }
        
        return array_filter($comments, function($comment) {
            return \ChristianSoronellas\BlogBundle\Entity\Comment::STATE_APPROVED == $comment->getState();
        });
    }
    
    /**
     * Returns all the post comments that has no parent
     * 
     * @return array 
     */
    public function getParentComments()
    {
        $comments = $this->getComments();
        
        if (!is_array($comments)) {
            $comments = $comments->toArray();
        }
        
        return array_filter($comments, function($comment) {
            return null === $comment->getParentComment()
                   && (\ChristianSoronellas\BlogBundle\Entity\Comment::STATE_APPROVED == $comment->getState());
        });
    }

    /**
     * Add comments
     *
     * @param ChristianSoronellas\BlogBundle\Entity\Comment $comments
     */
    public function addComment(\ChristianSoronellas\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    }

    /**
     * Add tags
     *
     * @param ChristianSoronellas\BlogBundle\Entity\Tag $tag
     */
    public function addTag(\ChristianSoronellas\BlogBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
    
    /**
     * Renders the instance as a string
     * 
     * @return string
     */
    public function  __toString()
    {
        return $this->getId() . '';
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set commentsEnabled
     *
     * @param boolean $commentsEnabled
     */
    public function setCommentsEnabled($commentsEnabled)
    {
        $this->commentsEnabled = $commentsEnabled;
    }

    /**
     * Get commentsEnabled
     *
     * @return boolean 
     */
    public function getCommentsEnabled()
    {
        return $this->commentsEnabled;
    }

    /**
     * Set state
     *
     * @param integer $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }
}
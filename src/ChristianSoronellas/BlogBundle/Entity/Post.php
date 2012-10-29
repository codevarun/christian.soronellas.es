<?php

namespace ChristianSoronellas\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ChristianSoronellas\BlogBundle\Entity\Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="ChristianSoronellas\BlogBundle\Entity\PostRepository")
 */
class Post
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var text $body
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;
    
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
     * @var datetime $created_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;
    
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

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Remove comments
     *
     * @param ChristianSoronellas\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\ChristianSoronellas\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Remove tags
     *
     * @param ChristianSoronellas\BlogBundle\Entity\Tag $tags
     */
    public function removeTag(\ChristianSoronellas\BlogBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }
}
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $body
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;
    
    /**
     * @var \Doctrine\Commons\Collections\ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    private $comments;

    /**
     * @var \DateTime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime $updated_at
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;
    
    /**
     * The slug for this post
     * 
     * @var string
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;
    
    /**
     *
     * @var \Doctrine\Commons\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts")
     * @ORM\JoinTable(name="posts_tags")
     */
    private $tags;
    
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     */
    public function setBody($body)
    {
        $this->body = $body;
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
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
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
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
        return array_filter($this->getComments()->toArray(), function($comment) {
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
        return array_filter($this->getComments()->toArray(), function($comment) {
            return null === $comment->getParentComment();
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
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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
    
    public function  __toString()
    {
        return $this->id . '';
    }
}
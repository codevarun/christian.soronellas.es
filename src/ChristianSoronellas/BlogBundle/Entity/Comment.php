<?php

namespace ChristianSoronellas\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Commons\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ChristianSoronellas\BlogBundle\Entity\Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ChristianSoronellas\BlogBundle\Entity\CommentRepository")
 */
class Comment
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
     * @var text $body
     *
     * Assert\NotBlank()
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var integer $state
     *
     * Assert\NotBlank()
     * @ORM\Column(name="state", type="integer")
     */
    private $state;

    /**
     * @var \DateTime $created_at
     * @Assert\DateTime()
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime $updated_at
     *
     * @Assert\DateTime()
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;
    
    /**
     * @var \ChristianSoronellas\BlogBundle\Entity\Post $post
     * 
     * @Assert\Type
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="posts")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;
    
    /**
     * The comment's parent
     * 
     * @var \ChristianSoronellas\BlogBundle\Entity\Comment $parentComment
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="comments")
     * @ORM\JoinColumn(name="comment_id", referencedColumnName="id") 
     */
    private $parentComment;
    
    /**
     * The subcomments of this comment
     * 
     * @var \Doctrine\Commons\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="parentComment")
     */
    private $comments;
    
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
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
     * Set body
     *
     * @param text $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return text 
     */
    public function getBody()
    {
        return $this->body;
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
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
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

    /**
     * Set category
     *
     * @param ChristianSoronellas\BlogBundle\Entity\Post $category
     */
    public function setPost(\ChristianSoronellas\BlogBundle\Entity\Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get category
     *
     * @return ChristianSoronellas\BlogBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set parentComment
     *
     * @param ChristianSoronellas\BlogBundle\Entity\Comment $parentComment
     */
    public function setParentComment(\ChristianSoronellas\BlogBundle\Entity\Comment $parentComment)
    {
        $this->parentComment = $parentComment;
    }

    /**
     * Get parentComment
     *
     * @return ChristianSoronellas\BlogBundle\Entity\Comment 
     */
    public function getParentComment()
    {
        return $this->parentComment;
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
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
<?php

namespace ChristianSoronellas\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

/**
 * ChristianSoronellas\BlogBundle\Entity\Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="ChristianSoronellas\BlogBundle\Entity\CommentRepository")
 * @ORM\HasLifeCycleCallbacks
 */
class Comment
{
    const STATE_AWAITING_MODERATION = 1;
    const STATE_APPROVED = 2;
    const STATE_REFUSED = 3;
    
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * The name of the commenter
     * 
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="name", type="string")
     */
    private $name;
    
    /**
     * The commenter's email
     * 
     * @var string
     * @Assert\NotBlank
     * @Assert\Email
     * @ORM\Column(name="email", type="string")
     */
    private $email;
    
    /**
     * The commenter's website
     * 
     * @var string
     * @Assert\Url
     * @ORM\Column(name="website", type="string", nullable="true")
     */
    private $website;
    
    /**
     * @var text $body
     *
     * @Assert\NotBlank
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var integer $state
     *
     * @ORM\Column(name="state", type="integer")
     */
    private $state;

    /**
     * @var \DateTime $created_at
     * @Assert\DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime $updated_at
     * @Assert\DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable="true")
     */
    private $updated_at;
    
    /**
     * @var \ChristianSoronellas\BlogBundle\Entity\Post $post
     * 
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="posts")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;
    
    /**
     * The comment's parent
     * 
     * @var \ChristianSoronellas\BlogBundle\Entity\Comment $parentComment
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
     * @param ChristianSoronellas\BlogBundle\Entity\Comment $comment
     */
    public function addComment(\ChristianSoronellas\BlogBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set website
     *
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }
    
    /**
     * @ORM\prePersist
     */
    public function addCreatedAtBeforeSave()
    {
        // If the state hasn't been set before
        if (null === $this->getState()) {
            $this->setState(static::STATE_AWAITING_MODERATION);
        }
        
        $this->setCreatedAt(new \DateTime());
    }
    
    /**
     * @ORM\preUpdate
     */
    public function updateUpdatedAtBeforeUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }
    
    public function __toString()
    {
        return $this->getId() . '';
    }
}
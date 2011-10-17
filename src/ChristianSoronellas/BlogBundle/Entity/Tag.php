<?php

namespace ChristianSoronellas\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ChristianSoronellas\BlogBundle\Entity\Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="ChristianSoronellas\BlogBundle\Entity\TagRepository")
 */
class Tag
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
     * @var string $tag
     *
     * @ORM\Column(name="tag", type="string", length=255)
     */
    private $tag;
    
    /**
     * @var \Doctrine\Commons\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
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
     * Set tag
     *
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Add posts
     *
     * @param ChristianSoronellas\BlogBundle\Entity\Post $post
     */
    public function addPost(\ChristianSoronellas\BlogBundle\Entity\Post $post)
    {
        $this->posts[] = $post;
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
    
    public function __toString()
    {
        return $this->getTag();
    }
}
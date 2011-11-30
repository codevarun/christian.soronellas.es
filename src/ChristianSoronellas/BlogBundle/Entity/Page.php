<?php

namespace ChristianSoronellas\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChristianSoronellas\BlogBundle\Entity\Page
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ChristianSoronellas\BlogBundle\Entity\PageRepository")
 */
class Page extends Content
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
     * @var \Doctrine\Commons\Collections\ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Page", mappedBy="parentPage")
     */
    private $pages;
    
    /**
     * The page parent
     * 
     * @var \ChristianSoronellas\BlogBundle\Entity\Page $parentPage
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="pages")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id") 
     */
    private $parentPage;

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
     * Set parent
     *
     * @param Page $parent
     */
    public function setParent(Page $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return \ChristianSoronellas\BlogBundle\Entity\Page 
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    public function __construct()
    {
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add pages
     *
     * @param ChristianSoronellas\BlogBundle\Entity\Page $pages
     */
    public function addPage(\ChristianSoronellas\BlogBundle\Entity\Page $pages)
    {
        $this->pages[] = $pages;
    }

    /**
     * Get pages
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set parentPage
     *
     * @param ChristianSoronellas\BlogBundle\Entity\Page $parentPage
     */
    public function setParentPage(\ChristianSoronellas\BlogBundle\Entity\Page $parentPage)
    {
        $this->parentPage = $parentPage;
    }

    /**
     * Get parentPage
     *
     * @return ChristianSoronellas\BlogBundle\Entity\Page 
     */
    public function getParentPage()
    {
        return $this->parentPage;
    }
}
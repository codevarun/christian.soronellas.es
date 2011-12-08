<?php

namespace ChristianSoronellas\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChristianSoronellas\BlogBundle\Entity\Page
 *
 * @ORM\Table(name="page")
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
<?php

namespace ChristianSoronellas\BlogBundle\Controller;

/**
 * This file is part of the christian.soronellas.es
 *
 * (c) Christian Soronellas <christian@sistemes-cayman.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ChristianSoronellas\BlogBundle\Entity\Page;

/**
 * Description of PagesController
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class PagesController extends Controller
{
    /**
     * @Route("/pages", name="pages")
     * @Template()
     */
    public function pagesAction()
    {
        $pages = $this->getDoctrine()
                      ->getRepository('ChristianSoronellasBlogBundle:Page')
                      ->findAll();
        
        return array('pages' => $pages);
    }
    
    /**
     * The page show action
     * 
     * @Route("/pages/{slug}", name="page")
     * @Template()
     */
    public function pageAction($slug)
    {
        $pages = $this->getDoctrine()
                      ->getRepository('ChristianSoronellasBlogBundle:Page')
                      ->findBySlug($slug);
        
        return array(
            'page' => array_shift($pages)
        );
    }
}
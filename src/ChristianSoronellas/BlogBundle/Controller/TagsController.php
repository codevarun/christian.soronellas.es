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
 * Description of TagsController
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class TagsController extends Controller
{
    /**
     * Shows the entries related to a tag
     * @param string $slug
     * @Route("/tag/{slug}", name="tag")
     * @Template()
     */
    public function tagAction($slug)
    {
        $tag = $this->getDoctrine()
                    ->getRepository('ChristianSoronellasBlogBundle:Tag')
                    ->findOneBySlug($slug);

        if (!$tag) {
            throw $this->createNotFoundException('The specified tag doesn\'t exists!');
        }
        
        return array(
            'tag' => $tag
        );
    }
}
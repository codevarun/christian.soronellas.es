<?php

namespace ChristianSoronellas\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ChristianSoronellas\BlogBundle\Entity\Post;
use ChristianSoronellas\BackofficeBundle\Form\PostType;

/**
 * Comments controller.
 *
 * @Route("/admin/comments")
 */
class AdminPostsController extends Controller
{
    /**
     * Lists all Comment entities.
     *
     * @Route("/", name="admin_comment")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ChristianSoronellasBlogBundle:Comment')->findAll();

        return array(
            'comments' => $entities
        );
    }
}

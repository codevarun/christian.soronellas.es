<?php

namespace ChristianSoronellas\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ChristianSoronellas\BlogBundle\Entity\Comment;

/**
 * Comments controller.
 *
 * @Route("/admin/comments")
 */
class AdminCommentsController extends Controller
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

    /**
     * @Route("/{id}/perform/{action}", name="admin_comment_action", requirements={"action" = "approve|refuse"})
     */
    public function actionAction(Comment $comment, $action)
    {
        $em = $this->getDoctrine()->getManager();

        if ('approve' == $action) {
            $comment->setState(Comment::STATE_APPROVED);
        } else {
            $comment->setState(Comment::STATE_REFUSED);
        }

        $em->persist($comment);
        $em->flush();

        $this->getRequest()->getSession()->getFlashBag()->add('notice', 'Comment has been modified successfully!');
        return $this->redirect($this->generateUrl('admin_comment'));
    }
}

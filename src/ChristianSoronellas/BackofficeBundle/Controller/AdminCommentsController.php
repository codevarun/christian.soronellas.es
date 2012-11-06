<?php

namespace ChristianSoronellas\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ChristianSoronellas\BlogBundle\Entity\Comment;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * AdminComments controller.
 */
class AdminCommentsController extends Controller
{
    /**
     * Lists all Comment entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ChristianSoronellasBlogBundle:Comment')->findAllOrderedByCreatedAt();

        return $this->container->get('templating')->renderResponse(
            'ChristianSoronellasBackofficeBundle:AdminComments:index.html.twig',
            array(
                'comments' => $entities
            )
        );
    }

    public function actionAction($id, $action)
    {
        $em = $this->container->get('doctrine')->getManager();

        $comment = $em->getRepository('ChristianSoronellasBlogBundle:Comment')->findOneById($id);

        if (!$comment) {
            throw new NotFoundHttpException();
        }

        if ('approve' == $action) {
            $comment->setState(Comment::STATE_APPROVED);
        } else {
            $comment->setState(Comment::STATE_REFUSED);
        }

        $em->persist($comment);
        $em->flush();

        $this->container->get('request')->getSession()->getFlashBag()->add('notice', 'Comment has been modified successfully!');
        return new RedirectResponse($this->container->get('router')->generate('admin_comment'));
    }
}

<?php

namespace ChristianSoronellas\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ChristianSoronellas\BlogBundle\Entity\Post;
use ChristianSoronellas\BackofficeBundle\Form\PostType;

/**
 * Post controller.
 *
 * @Route("/admin/posts")
 */
class AdminPostsController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @Route("/", name="admin_post")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ChristianSoronellasBlogBundle:Post')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Displays a form to create a new Post entity.
     *
     * @Route("/new", name="admin_post_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Post();
        $form = $this->createForm(new PostType());

        return array(
            'post' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Post entity.
     *
     * @Route("/create", name="admin_post_create")
     * @Method({"POST", "PUT"})
     * @Template("ChristianSoronellasBlogBundle:AdminPosts:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Post();
        $request = $this->getRequest();
        $form    = $this->createForm(new PostType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Post created successfully!');
            return $this->redirect($this->generateUrl('admin_post'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{id}/edit", name="admin_post_edit")
     * @Template()
     */
    public function editAction(Post $entity)
    {
        $editForm = $this->createForm(new PostType(), $entity);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing Post entity.
     *
     * @Route("/{id}/update", name="admin_post_update")
     * @Method({"POST", "PUT"})
     * @Template("ChristianSoronellasBlogBundle:AdminPosts:edit.html.twig")
     */
    public function updateAction(Post $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $editForm   = $this->createForm(new PostType(), $entity);
        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag('notice', 'The post has been updated!');
            return $this->redirect($this->generateUrl('admin_post'));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("/{id}/delete", name="admin_post_delete")
     * @Method("post")
     */
    public function deleteAction($slug)
    {
        $form = $this->createDeleteForm($slug);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ChristianSoronellasBlogBundle:Post')->findOneBySlug($slug);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_post'));
    }

    /**
     * Publishes a non published entry
     *
     * @param \ChristianSoronellas\BlogBundle\Entity\Post $entity
     *
     * @Route("/{id}/publish", name="admin_post_publish")
     */
    public function publishAction(Post $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $entity
            ->setState(Post::STATE_COMPLETE)
        ;

        $em->persist($entity);
        $em->flush();
        $this->getRequest()->getSession()->getFlashBag()->add('notice', 'Post published succesfully!');

        return $this->redirect($this->generateUrl('admin_post'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

<?php

namespace ChristianSoronellas\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ChristianSoronellas\BlogBundle\Entity\Post;
use ChristianSoronellas\BlogBundle\Form\PostType;

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
     * Finds and displays a Post entity.
     *
     * @Route("/{slug}/show", name="admin_post_show")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ChristianSoronellasBlogBundle:Post')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($slug);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView()
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

        // Fill the entity with some data
        $entity->setTitle('Título de la entrada');
        $entity->setBody('<p>Cuerpo de la entrada</p>');
        $entity->setCreatedAt(new \DateTime());

        return array(
            'post' => $entity
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

            return $this->redirect($this->generateUrl('admin_post_show', array('slug' => $entity->getSlug())));

        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{slug}/edit", name="admin_post_edit")
     * @Template()
     */
    public function editAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ChristianSoronellasBlogBundle:Post')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createForm(new PostType(), $entity);
        $deleteForm = $this->createDeleteForm($slug);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Post entity.
     *
     * @Route("/{slug}/update", name="admin_post_update")
     * @Method("post")
     * @Template("ChristianSoronellasBlogBundle:AdminPosts:edit.html.twig")
     */
    public function updateAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ChristianSoronellasBlogBundle:Post')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm   = $this->createForm(new PostType(), $entity);
        $deleteForm = $this->createDeleteForm($slug);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_post_edit', array('slug' => $slug)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("/{slug}/delete", name="admin_post_delete")
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

    private function createDeleteForm($slug)
    {
        return $this->createFormBuilder(array('slug' => $slug))
            ->add('slug', 'hidden')
            ->getForm()
        ;
    }
}

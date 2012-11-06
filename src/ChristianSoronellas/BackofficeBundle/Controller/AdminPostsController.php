<?php

namespace ChristianSoronellas\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ChristianSoronellas\BlogBundle\Entity\Post;
use ChristianSoronellas\BackofficeBundle\Form\PostType;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * AdminPosts controller.
 */
class AdminPostsController extends Controller
{
    /**
     * Lists all Post entities.
     */
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getManager();

        $entities = $em->getRepository('ChristianSoronellasBlogBundle:Post')->findAll();

        return $this->container->get('templating')->renderResponse(
            'ChristianSoronellasBackofficeBundle:AdminPosts:index.html.twig',
            array(
                'entities' => $entities
            )
        );
    }

    /**
     * Displays a form to create a new Post entity.
     */
    public function newAction()
    {
        $entity = new Post();
        $form = $this->container->get('form.factory')->create(new PostType(), $entity);

        return $this->container->get('templating')->renderResponse(
            'ChristianSoronellasBackofficeBundle:AdminPosts:new.html.twig',
            array(
                'post' => $entity,
                'form' => $form->createView()
            )
        );
    }

    /**
     * Creates a new Post entity.
     */
    public function createAction()
    {
        $request = $this->container->get('request');

        if (!$request->isMethod('POST') && !$request->isMethod('PUT')) {
            throw new HttpException(400);
        }

        $entity  = new Post();
        $form    = $this->container->get('form.factory')->create(new PostType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->container->get('doctrine')->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Post created successfully!');
            return new RedirectResponse($this->container->get('router')->generate('admin_post'));
        }

        return $this->container->get('templating')->renderResponse(
            'ChristianSoronellasBackofficeBundle:AdminPosts:new.html.twig',
            array(
                'post' => $entity,
                'form' => $form->createView()
            )
        );
    }

    /**
     * Displays a form to edit an existing Post entity.
     */
    public function editAction($id)
    {
        $em = $this->container->get('doctrine')->getManager();
        $entity = $em->getRepository('ChristianSoronellasBlogBundle:Post')->findOneById($id);

        if (!$entity) {
            throw new NotFoundHttpException();
        }

        $editForm = $this->container->get('form.factory')->create(new PostType(), $entity);

        return $this->container->get('templating')->renderResponse(
            'ChristianSoronellasBackofficeBundle:AdminPosts:edit.html.twig',
            array(
                'entity' => $entity,
                'form'   => $editForm->createView()
            )
        );
    }

    /**
     * Edits an existing Post entity.
     */
    public function updateAction(Post $entity)
    {
        $request = $this->getRequest();

        if (!$request->isMethod('POST') && !$request->isMethod('PUT')) {
            throw new HttpException(400);
        }

        $em = $this->container->get('doctrine')->getManager();
        $editForm = $this->container->get('form.factory')->create(new PostType(), $entity);

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag('notice', 'The post has been updated!');
            return new RedirectResponse($this->container->get('router')->generate('admin_post'));
        }

        return $this->container->get('templating')->renderResponse(
            'ChristianSoronellasBackofficeBundle:AdminPosts:edit.html.twig',
            array(
                'entity' => $entity,
                'form'   => $editForm->createView()
            )
        );
    }

    /**
     * Deletes a Post entity.
     */
    public function deleteAction($slug)
    {
        $request = $this->getRequest();

        if (!$request->isMethod('POST')) {
            throw new HttpException(400);
        }

        $form = $this->createDeleteForm($slug);

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->container->get('doctrine')->getManager();
            $entity = $em->getRepository('ChristianSoronellasBlogBundle:Post')->findOneBySlug($slug);

            if (!$entity) {
                throw new NotFoundHttpException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return new RedirectResponse($this->container->get('router')->generate('admin_post'));
    }

    /**
     * Publishes a non published entry
     *
     * @param \ChristianSoronellas\BlogBundle\Entity\Post $entity
     */
    public function publishAction($id)
    {
        $request = $this->container->get('request');
        $em = $this->container->get('doctrine')->getManager();

        $entity = $em->getRepository('ChristianSoronellasBlogBundle:Post')->findOneById($id);

        if (!$entity) {
            throw new NotFoundHttpException();
        }

        $entity
            ->setState(Post::STATE_COMPLETE)
        ;

        $em->persist($entity);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Post published succesfully!');

        return new RedirectResponse($this->container->get('router')->generate('admin_post'));
    }

    private function createDeleteForm($id)
    {
        return $this->container->get('form.factory')->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

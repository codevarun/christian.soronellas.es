<?php

namespace ChristianSoronellas\BlogBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

use ChristianSoronellas\BlogBundle\Entity\Post;
use ChristianSoronellas\BlogBundle\Entity\Comment;

/**
 * The Posts controller
 */
class PostsController extends ContainerAware
{
    /**
     * Displays the main posts list
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $postsRepository = $this->container->get('christian_soronellas.blog_bundle.entity.post_repository');
        $posts = $postsRepository->findPublishedOrderedByCreatedAt();

        return $this->container->get('templating')->renderResponse('ChristianSoronellasBlogBundle:Posts:index.html.twig', array('posts' => $posts));
    }

    /**
     * Display a post
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postAction($slug)
    {
        $em = $this->container->get('doctrine')->getManager();
        $post = $this->container->get('christian_soronellas.blog_bundle.entity.post_repository')->findOneBySlug($slug);

        if (!$post || Post::STATE_COMPLETE != $post->getState()) {
            throw new NotFoundHttpException('The post doesn\'t exists!');
        }

        $form = $this->container->get('christian_soronellas.blog_bundle.form.comment');

        return $this->container->get('templating')->renderResponse(
            'ChristianSoronellasBlogBundle:Posts:post.html.twig',
            array(
                'post' => $post,
                'form' => $form->createView()
            )
        );
    }

    /**
     * Adds a new comment to a given post
     *
     * @var \ChristianSoronellas\BlogBundle\Entity\Post $post
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commentAction($slug)
    {
        if (!$this->container->get('request')->isMethod('POST')) {
            throw new HttpException(400);
        }

        $post = $this->container->get('christian_soronellas.blog_bundle.entity.post_repository')->findOneBySlug($slug);

        if (false === $post->getCommentsEnabled()) {
            $this->get('session')->setFlash('notice', 'Comments on this entry are disabled!');

            return new RedirectResponse(
                $this->container->get('router')->generate(
                    'post',
                    array(
                            'day'   => $post->getCreatedAt()->format('d'),
                            'month' => $post->getCreatedAt()->format('m'),
                            'year'  => $post->getCreatedAt()->format('Y'),
                            'slug'  => $post->getSlug()
                    )
                )
            );
        }


        $form = $this->container->get('christian_soronellas.blog_bundle.form.comment');
        $form->bind($this->container->get('request'));

        if ($form->isValid()) {
            // OK! Proceed to save the new comment to the database!
            $em = $this->container->get('doctrine')->getManager();

            $comment = $form->getData();
            $comment->setPost($post);

            // Akismet filtering
            $comment->setState(Comment::STATE_APPROVED);
            if ($this->container->get('ornicar_akismet')->isSpam(array('comment_author' => $comment->getName(), 'comment_content' => $comment->getBody()))) {
                $comment->setState(Comment::STATE_IS_SPAM);
            }

            $em->persist($comment);

            $post->addComment($comment);

            $em->persist($post);
            $em->flush();

            $this->container->get('session')->getFlashBag()->add('notice', 'Your comment has been saved succesfully!');

            return new RedirectResponse(
                $this->container->get('router')->generate(
                    'post',
                    array(
                        'day'   => $post->getCreatedAt()->format('d'),
                        'month' => $post->getCreatedAt()->format('m'),
                        'year'  => $post->getCreatedAt()->format('Y'),
                        'slug'  => $post->getSlug()
                    )
                )
            );
        }

        return $this->container->get('templating')->renderResponse(
            'ChristianSoronellasBlogBundle:Posts:post.html.twig',
            array('post' => $post, 'form' => $form->createView())
        );
    }
}
<?php

namespace ChristianSoronellas\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ChristianSoronellas\BlogBundle\Form\CommentType;

class PostsController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()
                      ->getRepository('ChristianSoronellasBlogBundle:Post')
                      ->findAll();
        
        return array('posts' => $posts);
    }
    
    /**
     * @param type $id
     * 
     * @Route("/post/{id}", name="post")
     * @Template()
     */
    public function postAction($id)
    {
        $post = $this->getDoctrine()->getRepository('ChristianSoronellasBlogBundle:Post')->find($id);
        $form = $this->createForm(new CommentType());
        
        return array('post' => $post, 'form' => $form->createView());
    }
    
    /**
     * @param type $postId
     * 
     * @Route("/post/{id}/comment", name="post_comment")
     * @Method("post")
     */
    public function commentAction($id)
    {
        $post = $this->getDoctrine()->getRepository('ChristianSoronellasBlogBundle:Post')->find($id);
        $form = $this->createForm(new CommentType(), $data);
    }
}

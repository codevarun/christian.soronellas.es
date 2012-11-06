<?php

namespace ChristianSoronellas\BackofficeBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * The security controller
 *
 * @author csoronellas
 */
class AdminController extends ContainerAware
{
    public function indexAction()
    {
        return $this->container->get('http_kernel')->forward('ChristianSoronellasBackofficeBundle:AdminPosts:index');
    }

    public function loginAction()
    {
        $request = $this->container->get('request');
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->container->get('templating')->renderResponse(
            'ChristianSoronellasBackofficeBundle:Admin:login.html.twig',
            array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }
}
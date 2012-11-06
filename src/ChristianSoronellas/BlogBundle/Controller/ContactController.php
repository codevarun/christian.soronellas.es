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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Swift_Message;

/**
 * A controller to handle message submissions from the blog
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class ContactController extends Controller
{
    /**
     * Handles message submissions
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction()
    {
        $form = $this->container->get('christian_soronellas.blog_bundle.form.contact');
        $request = $this->container->get('request');

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $data = $form->getData();

                $from = $data['email'];
                if (isset($data['name'])) {
                    $from = array($data['email'] => $data['name']);
                }

                $message = Swift_Message::newInstance()
                    ->setSubject('New message from the blog')
                    ->setFrom($from)
                    ->setTo($this->container->getParameter('contact_email'))
                    ->setBody($data['body'])
                ;

                $this->container->get('mailer')->send($message);
                $request->getSession()->getFlashBag()->add('notice', 'Message sent successfully!');

                return new RedirectResponse(
                    $this->container->get('router')->generate('contact')
                );
            }
        }

        return $this->container->get('templating')->renderResponse(
            'ChristianSoronellasBlogBundle:Contact:contact.html.twig',
            array('form' => $form->createView())
        );
    }
}
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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ChristianSoronellas\BlogBundle\Form\ContactType;

/**
 * Description of ContactController
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 * @Route("/contact")
 */
class ContactController extends Controller
{
    /**
     * @Route("/", name="contact")
     * @Template()
     */
    public function contactAction()
    {
        $form = $this->createForm(new ContactType());
        $request = $this->getRequest();

        if ($request->isMethod('POST')) {
            $form->bind($this->getRequest());

            if ($form->isValid()) {
                $data = $form->getData();

                $from = $data['email'];
                if (isset($data['name'])) {
                    $from = array($data['email'] => $data['name']);
                }

                $message = \Swift_Message::newInstance()
                    ->setSubject('New message from the blog')
                    ->setFrom($from)
                    ->setTo($this->container->getParameter('contact_email'))
                    ->setBody($data['body'])
                ;

                $this->get('mailer')->send($message);
                $this->getRequest()->getSession()->getFlashBag()->add('notice', 'Message sent successfully!');
            }
        }

        return array(
            'form' => $form->createView()
        );
    }
}
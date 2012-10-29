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

        return array(
            'form' => $form->createView()
        );
    }
}
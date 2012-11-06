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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * A controller to handle generic pages
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class PagesController extends ContainerAware
{
    /**
     * Generates an RSS feed
     *
     * @return Response
     */
    public function rssAction()
    {
        $feed = new \Zend\Feed\Writer\Feed();
        $feed
            ->setTitle('Christian Soronellas Web Architect')
            ->setLink('http://christian.soronellas.es')
            ->setFeedLink('http://christian.soronellas.es/rss', 'rss')
            ->addAuthor(array(
                'name'  => 'Christian Soronellas',
                'email' => 'theunic@gmail.com',
                'uri'   => 'http://christian.soronellas.es'
            ))
            ->setDateModified(time())
            ->setCopyright('Christian Soronellas Vallespí')
            ->setEncoding('UTF-8')
            ->setDescription('Christian Soronellas Blog Feed')
        ;

        $em = $this->container->get('doctrine')->getManager();
        $postsRepository = $em->getRepository('ChristianSoronellasBlogBundle:Post');

        $posts = $postsRepository->findPublishedOrderedByCreatedAt();

        foreach ($posts as $post) {
            $entry = $feed->createEntry();
            $entry
                ->setTitle($post->getTitle())
                ->setLink($this->container->get('router')->generate('post', array('year' => $post->getCreatedAt()->format('Y'), 'month' => $post->getCreatedAt()->format('m'), 'day' => $post->getCreatedAt()->format('d'), 'slug' => $post->getSlug())))
                ->addAuthor(array('name' => 'Christian Soronellas', 'email' => 'theunic@gmail.com', 'uri' => 'http://christian.soronellas.es'))
                ->setDateModified($post->getUpdatedAt())
                ->setDateCreated($post->getCreatedAt())
                ->setContent($post->getBody())
            ;

            $feed->addEntry($entry);
        }


        $out = $feed->export('rss');
        $response = new Response($out);
        $response->headers->set('Content-type', 'application/rss+xml');

        return $response;
    }
}
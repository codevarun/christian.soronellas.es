<?php

namespace ChristianSoronellas\BlogBundle\Feed;

/**
 * A feed generator built on top of the Zend\Feed component
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class Generator
{
    /**
     * The Zend_Feed writer
     *
     * @var \Zend\Feed\Writer\Feed
     */
    private $_feed;

    /**
     * The path where the feed will be generated
     *
     * @var string
     */
    private $_feedPath;

    /**
     * The router instance
     *
     * @var \Symfony\Component\Routing\Router
     */
    private $_router;

    /**
     * Class constructor
     *
     * @param \Zend\Feed\Writer\Feed $feed
     * @param \Symfony\Component\Routing\Router $router
     * @param string $feedPath
     */
    public function __construct(\Zend\Feed\Writer\Feed $feed, \Symfony\Component\Routing\Router $router, $feedPath)
    {
        $this->_feed = $feed;
        $this->_router = $router;
        $this->_feedPath = $feedPath;
    }

    /**
     * Generates an rss feed
     *
     * @param array $posts
     * @throws \Exception
     */
    public function generate(array $posts)
    {
        if (null === $this->_feed) {
            throw new \Exception('The feed writer cannot be null!');
        }

        if (null === $this->_feedPath) {
            throw new \Exception('The feed path cannot be null!');
        }

        foreach ($posts as $post) {
            $feedEntry = $this->_feed->createEntry();
            $feedEntry->addAuthor('Christian Soronellas', 'christian@sistemes-cayman.es', 'http://christian.soronellas.es');
            $feedEntry->setCommentCount(sizeof($post->getApprovedComments()));
            $feedEntry->setContent($post->getBody());
            $feedEntry->setCopyright('Christian Soronellas Vallespí');
            $feedEntry->setDateCreated($post->getCreatedAt());
            $feedEntry->setDateModified($post->getUpdatedAt());
            $feedEntry->setId($post->getId());
            $feedEntry->setLink(
                $this->_router->generate(
                    'post',
                    array(
                        'day'   => $post->getCreatedAt()->format('d'),
                        'month' => $post->getCreatedAt()->format('m'),
                        'year'  => $post->getCreatedAt()->format('Y'),
                        'slug'  => $post->getSlug()
                    ),
                    true
                )
            );
            $feedEntry->setTitle($post->getTitle());
            $this->_feed->addEntry($feedEntry);
        }

        file_put_contents($this->_feedPath, $this->_feed->export('rss'));
    }
}
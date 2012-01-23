<?php

namespace ChristianSoronellas\BlogBundle\Feed\Importer;

use ChristianSoronelas\BlogBundle\Entity\Post;
use ChristianSoronellas\BlogBundle\Feed\Importer\DoctrineImporter;
use ChristianSoronellas\BlogBundle\Feed\Importer\CommentImporter;

/**
 * A feed importer class built on top of Zend\Feed
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class PostImporter extends DoctrineImporter
{
    /**
     * The comments importer
     *
     * @var \ChristianSoronellas\BlogBundle\Feed\Importer
     */
    private $commentImporter;

    /**
     * The feed URI
     *
     * @var string
     */
    private $feedUri;

    /**
     * @return \ChristianSoronellas\BlogBundle\Feed\Importer $commentImporter
     */
    public function getCommentImporter()
    {
        return $this->commentImporter;
    }

	/**
     * @return string $feedUri
     */
    public function getFeedUri()
    {
        return $this->feedUri;
    }

	/**
     * @param \ChristianSoronellas\BlogBundle\Feed\Importer $commentImporter
     */
    public function setCommentImporter(\ChristianSoronellas\BlogBundle\Feed\Importer $commentImporter)
    {
        $this->commentImporter = $commentImporter;
    }

	/**
     * @param string $feedUri
     */
    public function setFeedUri($feedUri)
    {
        $this->feedUri = $feedUri;
    }

	/**
     * Imports a feed URI
     *
     * @param string $feedUri
     */
    public function import()
    {
        if (null === $this->getFeedUri()) {
            throw new \ChristianSoronellas\BlogBundle\Feed\Importer\Exception('A valid feed URI must be specified!');
        }

        $feed = \Zend\Feed\Reader\Reader::import($this->getFeedUri());

        foreach ($feed as $feedEntry) {
            $this->_addEntry($feedEntry);
        }
    }

    private function _addEntry(Zend\Feed\Reader\Entry\AbstractEntry $entry)
    {
        $post = new Post();

        $post->setTitle($entry->getTitle());
        $post->setBody($entry->getContent());
        $post->setCreatedAt(new \DateTime($entry->getDateCreated()));
        $post->setUpdatedAt(new \DateTime($entry->getDateModified()));

        if (0 < $entry->getCommentCount) {
            $commentImporter = $this->getCommentImporter();
            $commentImporter->setFeedUri($entry->getCommentFeedLink());
            $commentImporter->setPost($post);

            $commentImporter->import();
        }

        $em = $this->getEntityManager();
        $em->persist($post);
        $em->flush();
    }
}
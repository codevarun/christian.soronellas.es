<?php

namespace ChristianSoronellas\BlogBundle\Feed\Importer;

use ChristianSoronellas\BlogBundle\Feed\Importer\PostImporter;
use ChristianSoronellas\BlogBundle\Entity\Post;
use ChristianSoronellas\BlogBundle\Entity\Comment;

/**
 * The comments importer
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class CommentImporter extends PostImporter
{
    /**
     * The post where the comments belong to
     *
     * @var \ChristianSoronellas\BlogBundle\Entity\Post
     */
    private $post;

    /**
     * @return \ChristianSoronellas\BlogBundle\Entity\Post $post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param \ChristianSoronellas\BlogBundle\Entity\Post $post
     */
    public function setPost(\ChristianSoronellas\BlogBundle\Entity\Post $post)
    {
        $this->post = $post;
    }

    /**
     * (non-PHPdoc)
     * @see ChristianSoronellas\BlogBundle\Feed\Importer\DoctrineImporter::import()
     */
    public function import()
    {
        $commentsFeed = Zend\Feed\Reader\Feed::import($this->getFeedUri());

        foreach ($commentsFeed as $comment) {
            $this->_addComment($comment);
        }
    }

    protected function _addComment(Zend\Feed\Reader\Entry\AbstractEntry $entry)
    {
        $comment = new Comment();

        $comment->setBody($entry->getContent());
        $comment->setCreatedAt(new DateTime($entry->getDateCreated()));
        $comment->setUpdatedAt(new DateTime($entry->getDateModified()));

        // Author
        list($name, $email) = explode(' ', $entry->getAuthor());
        $comment->setEmail(trim($email, '<>'));
        if (null !== $name) {
            $comment->setName($name);
        }

        $comment->setState(Comment::STATE_APPROVED);

        $this->post->addComment($comment);
        $comment->setPost($this->post);
    }
}
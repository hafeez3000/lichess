<?php

namespace Application\ForumBundle;

use Ornicar\AkismetBundle\Akismet\AkismetInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Bundle\ForumBundle\Router\ForumUrlGenerator;
use Application\ForumBundle\Document\Post;
use Application\ForumBundle\Document\Topic;
use Zend\Service\Akismet\Exception as AkismetException;

class Akismet
{
    protected $akismet;

    public function __construct(AkismetInterface $akismet)
    {
        $this->akismet         = $akismet;
    }

    public function isPostSpam(Post $post)
    {
        return $this->akismet->isSpam($this->getPostData($post));
    }

    public function isTopicSpam(Topic $topic)
    {
        return $this->akismet->isSpam($this->getTopicData($topic));
    }

    protected function getPostData(Post $post)
    {
        return array(
            'comment_type'    => 'comment',
            'comment_author'  => $post->getAuthorName(),
            'comment_content' => $post->getMessage()
        );
    }

    protected function getTopicData(Topic $topic)
    {
        return array(
            'comment_type'    => 'comment',
            'comment_author'  => $topic->getFirstPost()->getAuthorName(),
            'comment_content' => $topic->getSubject().' '.$topic->getFirstPost()->getMessage()
        );
    }
}

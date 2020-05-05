<?php

namespace Jag\Exceptions\GooglePubSub;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TopicNotFoundException extends NotFoundHttpException
{
    /**
     * @var string|\Google\Cloud\PubSub\Topic
     */
    protected $topic;

    /**
     * @var string
     */
    protected $rawMessage;

    public function __construct($topic, $message, $previous)
    {
        $this->topic = $topic;
        $this->rawMessage = $message;
        parent::__construct($this->formatMessage($message), $previous);
    }

    protected function formatMessage($message) : string
    {
        $msg = json_decode($message, true);

        if (json_last_error()) {
            return $this->createMessage($message, $this->topic);
        }

        return $this->createMessage($msg['error']['message'], $this->topic);
    }

    private function createMessage($message, $topic) : string
    {
        return implode(' : ', [$message, $topic]);
    }

    /**
     * @return string|\Google\Cloud\PubSub\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    public function getRawMessage() : string
    {
        return $this->rawMessage;
    }
}

<?php

namespace Jag\Exceptions\GooglePubSub;

use RuntimeException;

class KeyNotFoundException extends RuntimeException
{
    /**
     * @var string
     */
    protected $path;

    /**
     * KeyNotFoundException constructor.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
        parent::__construct('Key not found at ' . $path);
    }

    public function getPath() : string
    {
        return $this->path;
    }
}

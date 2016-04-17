<?php

namespace Pimterest\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Raw tweet data
 */
class Tweet
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $content;

    /**
     * Tweet constructor.
     *
     * @param string $id
     * @param string $content
     */
    public function __construct($id, $content)
    {
        $this->id = $id;
        $this->content = $content;
    }

    public function getAppId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }
}

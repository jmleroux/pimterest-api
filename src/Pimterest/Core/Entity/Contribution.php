<?php

namespace Pimterest\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contribution
 */
class Contribution
{
    /** @var integer */
    protected $id;

    /** @var string */
    protected $source;

    /** @var string */
    protected $appId;

    /** @var string */
    protected $username;

    /** @var string */
    protected $userType;

    /** @var string */
    protected $mediaUrl;

    /** @var boolean */
    protected $active;

    /** @var string */
    protected $content;

    /** @var string */
    protected $latitude;

    /** @var string */
    protected $longitude;

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'source' => $this->getSource(),
            'app_id' => $this->getAppId(),
            'username' => $this->getUsername(),
            'usertype' => $this->getUserType(),
            'mediaurl' => $this->getMediaUrl(),
            'active' => $this->isActive(),
            'content' => $this->getContent(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude()
        ];
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Contribution
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set appId
     *
     * @param string $appId
     * @return Contribution
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * Get appId
     *
     * @return string 
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Contribution
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set userType
     *
     * @param string $userType
     * @return Contribution
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return string 
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Set mediaUrl
     *
     * @param string $mediaUrl
     * @return Contribution
     */
    public function setMediaUrl($mediaUrl)
    {
        $this->mediaUrl = $mediaUrl;

        return $this;
    }

    /**
     * Get mediaUrl
     *
     * @return string 
     */
    public function getMediaUrl()
    {
        return $this->mediaUrl;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Contribution
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Contribution
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Contribution
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Contribution
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
}

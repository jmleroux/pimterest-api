<?php

namespace Pimterest\AppBundle\Instagram;

use MetzWeb\Instagram\Instagram;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * @author    Adrien Pétremann <adrien.petremann@akeneo.com>
 * @copyright 2015 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class InstagramReader implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    protected $tag;
    protected $settings;

    public function __construct($tag, $apiKey, $apiSecret, $apiCallback)
    {
        $this->tag = trim($tag);

        $this->settings = [
            'apiKey'      => $apiKey,
            'apiSecret'   => $apiSecret,
            'apiCallback' => $apiCallback
        ];
    }

    public function retrieve()
    {
        $formatted = [];

        $response = $this->getInstagram()->getTagMedia($this->tag);
        $data = $response->data;

        foreach ($data as $postData) {
            $formatted[] = $this->extractPost($postData);
        }

        return $formatted;
    }

    protected function extractPost($data)
    {
        return [
            'app_id'    => $data->id,
            'source'    => 'instagram',
            'username'  => $data->user->username,
            'usertype'  => 'community',
            'mediaurl'  => $data->images->standard_resolution->url,
            'active'    => true,
            'content'   => $data->caption->text,
            'latitude'  => $data->location ? $data->location->latitude : '',
            'longitude' => $data->location ? $data->location->longitude : ''
        ];
    }

    protected function getInstagram()
    {
        return new Instagram($this->settings['apiKey']);
    }
}

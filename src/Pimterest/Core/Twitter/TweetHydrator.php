<?php

namespace Pimterest\AppBundle\Twitter;

use Pimterest\AppBundle\Entity\Contribution;

class TweetHydrator
{
    public function hydrate(\stdClass $data, Contribution $contribution)
    {
        $formatted = $this->parseData($data);

        $contribution->setSource($formatted['source']);
        $contribution->setAppId($formatted['app_id']);
        $contribution->setUsername($formatted['username']);
        $contribution->setUserType($formatted['usertype']);
        $contribution->setMediaUrl($formatted['mediaurl']);
        $contribution->setActive($formatted['active']);
        $contribution->setContent($formatted['content']);
        $contribution->setLatitude($formatted['latitude']);
        $contribution->setLongitude($formatted['longitude']);
    }

    public function extract(Contribution $contribution)
    {
        return [
            'source' => $contribution->getSource(),
            'app_id' => $contribution->getAppId(),
            'username' => $contribution->getUsername(),
            'usertype' => $contribution->getUserType(),
            'mediaurl' => $contribution->getMediaUrl(),
            'active' => $contribution->isActive(),
            'content' => $contribution->getContent(),
            'latitude' => $contribution->getLatitude(),
            'longitude' => $contribution->getLongitude()
        ];
    }

    private function parseData(\stdClass $data)
    {
        if (isset($data->retweeted_status)) {
            return [];
        }

        $formatted = [
            'app_id'    => $data->id,
            'source'    => 'twitter',
            'username'  => $data->user->screen_name,
            'usertype'  => 'community',
            'active'    => true,
            'content'   => $data->text,
            'mediaurl'  => null,
            'latitude'  => 0,
            'longitude' => 0,
        ];

        if (isset($data->entities->media) && count((array)$data->entities->media)) {
            $media = $data->entities->media;
            $formatted['mediaurl'] = $media[0]->media_url;
        }

        if ($data->coordinates) {
            $formatted['latitude'] = $data->location ? $data->location->latitude : '';
            $formatted['longitude'] = $data->location ? $data->location->longitude : '';
        } elseif (isset($data->place->bounding_box->coordinates)) {
            $coordinates = $data->place->bounding_box->coordinates;
            $formatted['latitude'] = $coordinates[0][0][1];
            $formatted['longitude'] = $coordinates[0][0][0];
        }

        return $formatted;
    }
}

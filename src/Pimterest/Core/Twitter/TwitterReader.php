<?php

namespace Pimterest\AppBundle\Twitter;

use TwitterAPIExchange;

class TwitterReader
{
    protected $settings;

    protected $tag;

    public function __construct() {
    }

    public function retrieve()
    {
        $url           = 'https://api.twitter.com/1.1/search/tweets.json';
        $getfield      = sprintf('?q=#%s', $this->tag);
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->settings);

        $response = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        $data = json_decode($response);

        $formatted = [];

        foreach ($data->statuses as $postData) {
            $parsed = $this->extractPost($postData);
            if (count($parsed) > 0) {
                $formatted[] = $parsed;
            }
        }

        return $formatted;
    }

    protected function extractPost($data)
    {
        if (isset($data->retweeted_status)) {
            return null;
        }

        $formatted = [
            'app_id'    => $data->id,
            'source'    => 'twitter',
            'username'  => $data->user->screen_name,
            'usertype'  => 'community',
            'active'    => true,
            'content'   => $data->text,
            'mediaurl' => null,
            'latitude' => 0,
            'longitude' => 0,
        ];

        if (isset($data->entities->media) && count((array) $data->entities->media)) {
            $media = $data->entities->media;
            $formatted['mediaurl'] = $media[0]->media_url;
        }

        if ($data->coordinates) {
            $formatted['latitude']  = $data->location ? $data->location->latitude : '';
            $formatted['longitude'] = $data->location ? $data->location->longitude : '';
        } elseif (isset($data->place->bounding_box->coordinates)) {
            $coordinates = $data->place->bounding_box->coordinates;
            $formatted['latitude']  = $coordinates[0][0][1];
            $formatted['longitude'] = $coordinates[0][0][0];
        }

        return $formatted;
    }
}

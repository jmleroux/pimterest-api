<?php

namespace Pimterest\AppBundle\Twitter;

use Doctrine\ORM\EntityManager;
use Pimterest\AppBundle\Entity\Tweet;
use TwitterAPIExchange;

/**
 * Store all raw tweets
 */
class TwitterStorer
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var array
     */
    private $settings;

    /**
     * @var string
     */
    private $tag;

    public function __construct(
        EntityManager $em,
        $tag,
        $oauth_access_token,
        $oauth_access_token_secret,
        $consumer_key,
        $consumer_secret
    ) {
        $this->em = $em;
        $this->tag = trim($tag);

        $this->settings = [
            'oauth_access_token'        => $oauth_access_token,
            'oauth_access_token_secret' => $oauth_access_token_secret,
            'consumer_key'              => $consumer_key,
            'consumer_secret'           => $consumer_secret,
        ];
    }

    public function retrieve()
    {
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $getfield = sprintf('?q=#%s', $this->tag);
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->settings);

        $response = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        $tweets = json_decode($response);

        $repository = $this->em->getRepository(Tweet::class);

        $newTweets = 0;

        foreach ($tweets->statuses as $tweet) {
            if (!$repository->findOneBy(['id' => $tweet->id])) {
                $model = new Tweet($tweet->id, json_encode($tweet));
                $this->em->persist($model);
                $newTweets += 1;
            }
        }

        $this->em->flush();

        return $newTweets;
    }
}

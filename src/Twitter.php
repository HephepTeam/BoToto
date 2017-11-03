<?php
namespace BoToto;

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'),
            config('twitter.access_token'),
            config('twitter.access_token_secret')
        );
    }

    public function tweet(string $tweet)
    {
        $this->connection->post('statuses/update', ['status' => $tweet]);
    }

    public function respond(string $tweet, int $tweetId, string $at)
    {
        $this->connection->post('statuses/update', [
           'status' => '@' . $at . ' ' . $tweet,
           'in_reply_to_status_id' => $tweetId,
        ]);
    }

    public function searchByMention($at)
    {
        return $this->connection->get('search/tweets', ['q' => '@' . strtolower($at)]);
    }
}

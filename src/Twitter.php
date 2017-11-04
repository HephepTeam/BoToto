<?php
/*
 * (c) Jules-Gil Primo <julesgil.primo@gmail.com>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    /**
     * @param string $tweet
     */
    public function tweet(string $tweet)
    {
        $this->connection->post('statuses/update', ['status' => $tweet]);
    }

    /**
     * @param string $tweet
     * @param int $tweetId
     * @param string $at
     * @return array|object
     */
    public function respond(string $tweet, int $tweetId, string $at)
    {
        return $this->connection->post('statuses/update', [
           'status' => '@' . $at . ' ' . $tweet,
           'in_reply_to_status_id' => $tweetId,
        ]);
    }

    /**
     * @param Query $query
     * @param int|null $sinceId
     * @return null|\stdClass
     */
    public function search(Query $query, int $sinceId = null): ?\stdClass
    {
        $params = [
            'q' => $query->build(),
        ];

        if($sinceId !== null) {
            $params['since_id'] = $sinceId;
        }

        return $this->connection->get('search/tweets', $params);
    }
}

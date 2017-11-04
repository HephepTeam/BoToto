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

class Song
{
    protected $title;

    protected  $url;

    public function __construct()
    {
        $songlist = require __DIR__ . '/../ressources/songlist.php';

        $this->title = array_rand($songlist);
        $this->url = $songlist[$this->title];
    }

    public function getTweet()
    {
        return $this->title . ' ♫ ' . $this->url;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getUrl()
    {
        return $this->url;
    }
}

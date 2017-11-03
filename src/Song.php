<?php

namespace BoToto;

class Song
{
    protected $title;

    protected  $url;

    public function __construct()
    {
        $songlist = require __DIR__ . '/config/songlist.php';

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

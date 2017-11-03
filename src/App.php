<?php
namespace BoToto;

use Abraham\TwitterOAuth\TwitterOAuth;

class App
{
    public function launch()
    {
        $twitter = new Twitter();

        $twitter->tweet('Hello hello');
    }
}

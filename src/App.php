<?php

namespace BoToto;

class App
{
    public function launch()
    {
        $twitter = new Twitter();
        $time = time();

        while (1) {
            $newTime = time();
            $rand = mt_rand(0, 9);
            $hour = (int)date('H');

            if ($newTime - $time >= 3600) {
                echo $rand;
                if ($rand > 6
                    && $hour > 9
                    && $hour < 23
                ) {
                    $song = new Song();
                    $twitter->tweet($song->getTweet());
                }

                $time = $newTime;
            }

            sleep(10);
        }
    }
}

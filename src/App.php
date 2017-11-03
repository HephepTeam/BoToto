<?php
namespace BoToto;

class App
{
    public function launch()
    {
        $twitter = new Twitter();

        while(1) {
            $rand = mt_rand(0,9);
            $hour = (int)date('H');
            if($rand > 7 && $hour > 9 && $hour < 23) {
                $twitter->tweet('Zog');
            }

            sleep(3600);
        }
    }
}

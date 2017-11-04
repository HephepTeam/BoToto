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

            $query = new Query();
            $query->at('BoTotoBoToto');

            $lastRespondedId = null;

            if(file_exists(__DIR__ . '/../ressources/lastRespondedId.txt')) {
                $file = new \SplFileObject(
                    __DIR__ . '/../ressources/lastRespondedId.txt'
                );
                $lastRespondedId = $file->getSize() > 0
                    ? (int)$file->fread($file->getSize())
                    : null;
            } else {
                $file = new \SplFileObject(
                    __DIR__ . '/../ressources/lastRespondedId.txt',
                    'w+'
                );
            }

            $mentions = $twitter->search($query, $lastRespondedId);

            foreach ($mentions->statuses as $status) {
                $id = $status->id;
                $at = $status->user->screen_name;
                $song = new Song();
                $response = 'What about some ' . $song->getTitle()
                    . '? :) ' . $song->getUrl();

                $lastTweet = $twitter->respond($response, $id, $at);
                if(!property_exists($lastTweet, 'errors')) {
                    $lastRespondedId = $lastTweet->id;
                }
            }

            if($lastRespondedId !== null) {
                $file = $file->openFile('w+');
                $file->fwrite($lastRespondedId);
            }

            sleep(10);
        }
    }
}

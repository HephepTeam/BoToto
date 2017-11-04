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
                $this->log(
                    'Rand is: '
                        . $rand
                        . ' '
                        . ($rand > 6 ? 'Throwing a SONG !' : 'No song :(')
                );
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
                $this->log(
                    'Responding to '
                        . $at
                        . '#'
                        . $id
                        .' with '
                        . $song->getTitle()
                );
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

            sleep(60);
        }
    }

    public function log(string $message, bool $err = false)
    {
        $log = new Log($message, $err);
        $log->log();
    }

    public function errLog(string $message)
    {
        $this->log($message, true);
    }
}

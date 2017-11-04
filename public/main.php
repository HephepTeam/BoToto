<?php
/*
 * (c) Jules-Gil Primo <julesgil.primo@gmail.com>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__ . '/../vendor/autoload.php';

use BoToto\{
    App,
    Config
};

function config($key) {
    $config = Config::getInstance();
    return $config->get($key);
}

$app = new App();

try {
    $app->log('Launching now ^_^');
    $app->launch();
} catch(\Exception $e) {
    $app->errLog($e);
}

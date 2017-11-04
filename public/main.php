<?php
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

$app->launch();

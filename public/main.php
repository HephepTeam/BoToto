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

try {
    $app->launch();
    fwrite(STDOUT, 'I\'m running ^_^');
} catch(\Exception $e) {
    fwrite(STDERR, $e);
}

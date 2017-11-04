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

class Config
{
    protected $config;

    protected static $instance;

    public function __construct()
    {
        $this->config = require __DIR__ . '/config/config.php';
    }

    public function get(string $configKey)
    {
        $keys = explode('.', $configKey);

        return $this->search($keys, $this->config);
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function search($keys, $conf)
    {
        $key = array_shift($keys);
        $conf = $conf[$key];
        if (count($keys) !== 0) {
            return $this->search($keys, $conf);
        }

        return $conf;
    }
}

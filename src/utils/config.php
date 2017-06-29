<?php

namespace App\Utils;

class Config
{
    private static $instance = null;

    private $configuration;

    private function __construct()
    {
        $this->configuration = new \Noodlehaus\Config('config.json');
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new \App\Utils\Config();
        }

        return self::$instance;
    }


    public function config()
    {
        return $this->configuration;
    }
}

<?php

/**
 * Include app packages
 */


require realpath(__DIR__ . '/..') . '/vendor/autoload.php';

foreach (glob("./src/**/*.php") as $filename) {
    require_once $filename;
}

<?php

require realpath(__DIR__ . '/..') . '/vendor/autoload.php';

foreach (glob("./src/**/*.php") as $filename) {
    require_once $filename;
}

$config = \App\Utils\Config::getInstance()->config();

// Connect to database
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($config->get('database'));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = new \Slim\App;

$app->get('/users', ['\App\Customer\Controller', 'list']);

$app->run();

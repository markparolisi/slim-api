<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require realpath(__DIR__ . '/..') . '/vendor/autoload.php';


// Connect to database
$capsule = new \Illuminate\Database\Capsule\Manager;

// In a real app, this should be loaded in via un-versioned config
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'slim_demo',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();


foreach (glob("./src/**/*.php") as $filename) {
    require_once $filename;
}


$app = new \Slim\App;


$app->get('/users', ['\App\Customer\Controller', 'list']);


$app->run();

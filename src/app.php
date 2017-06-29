<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require realpath(__DIR__ . '/..') . '/vendor/autoload.php';

foreach (glob("./src/**/*.php") as $filename) {
    require_once $filename;
}


$app = new \Slim\App;


$app->get('/users', ['\App\User\UserController', 'list']);


$app->run();

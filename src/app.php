<?php

require realpath(__DIR__ . "/..") . "/vendor/autoload.php";

foreach (glob("./src/**/*.php") as $filename) {
    require_once $filename;
}

$config = \App\Utils\Config::getInstance()->config();

// Connect to database
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($config->get("database"));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = new \Slim\App;


// Use JWT auth, do not authenticate the token endpoint or the ping endpoint
$app->add(new \Slim\Middleware\JwtAuthentication([
    "path" => ["/"],
    "passthrough" => ["/token", "/ping"],
    "secret" => $config->get("authTokenKey"),
    "error" => function ($request, $response, $arguments) {
        $data["status"] =     "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withStatus(401)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));


$app->get("/ping", function ($request, $response) {
    return $response->write("pong");
});

$app->post("/token", ["\App\Token\Controller", "generate"]);

$app->get("/customers", ["\App\Customer\Controller", "list"]);

$app->run();

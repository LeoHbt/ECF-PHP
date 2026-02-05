<?php
session_start();
$router = new AltoRouter();

// Pages Router
$router->map("GET", "/", function() {
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "controller" . DIRECTORY_SEPARATOR . "home.php";
});
$router->map("GET|POST", "/connection", function() {
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "controller" . DIRECTORY_SEPARATOR . "connection.php";
});
$router->map("POST", "/check_user", function() {
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "controller" . DIRECTORY_SEPARATOR . "check_user.php";
});

// Execute fonction si match
$match = $router->match();
if (is_array($match) && is_callable($match["target"])) {
    call_user_func_array($match["target"], $match["params"]);
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    exit();
}
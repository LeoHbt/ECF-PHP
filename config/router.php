<?php

$router = new AltoRouter();

$router->map("GET", "/", function() {
    global $twig;
    echo $twig->render("home.html.twig", []);
});

$match = $router->match();

if (is_array($match) && is_callable($match["target"])) {
    call_user_func_array($match["target"], $match["params"]);
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    exit();
}
<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(dirname(__DIR__) . DIRECTORY_SEPARATOR . "view");
$twig = new Environment($loader, [
    "cache" => false
]);
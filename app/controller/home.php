<?php
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";

echo $twig->render("home.html.twig", [
    "page_title" => "Bibliothèque - Home"
]);
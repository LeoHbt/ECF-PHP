<?php

use App\model\Author;

session_start();
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";

echo $twig->render("auteurs.html.twig", [
    "page_title" => "Bibliothèque - Auteurs",
    "authors" => Author::getAllAuthors()
]);
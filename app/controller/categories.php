<?php

use App\model\Category;

session_start();
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";

echo $twig->render("categories.html.twig", [
    "page_title" => "Bibliothèque - Auteurs",
    "categories" => Category::getAllCategories()
]);
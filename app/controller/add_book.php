<?php
session_start();
use App\model\Book;
use App\model\Author;
use App\model\Category;

require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";

echo $twig->render("add_book.html.twig", [
    "page_title" => "Bibliothèque - Ajouter un Livre",
    "authors" => Author::getAllAuthors(),
    "categories" => Category::getAllCategories()
]);

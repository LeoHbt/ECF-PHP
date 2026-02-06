<?php
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";
use App\model\Book;

echo $twig->render("home.html.twig", [
    "page_title" => "Bibliothèque - Home",
    "books" => Book::getAllBooks()
]);

echo "<pre>";
foreach (Book::getAllBooks() as $value) {
    var_dump($value);
}
echo "</pre>";

var_dump(Book::getAllBooks());


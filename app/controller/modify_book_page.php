<?php
session_start();
use App\model\Book;
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";

if ($_SESSION["role"] != "admin") {
    header("Location: /");
    exit();
}

$currentBook = Book::getBookData((int)$id);

echo $twig->render("modify_book_page.html.twig", [
    "page_title" => "Bibliothèque - Modify",
    "book_id" => $currentBook["id"],
    "book_title" => $currentBook["titre"],
    "book_year" => $currentBook["annee_publication"],
    "book_synopsis" => $currentBook["synopsis"],
    "book_modified" => $_SESSION["modified_book"]
]);

$_SESSION["modified_book"] = false;
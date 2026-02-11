<?php
session_start();
use App\model\Book;
use App\model\Author;
use App\model\Category;

require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";

if ($_SESSION["role"] != "admin") {
    header("Location: /");
    exit();
}

$correctTitle = false;
$correctAuthor = false;
$correctCategory = false;
$correctYear = false;
$correctISBN = false;
$correctSynopsis = false;
$correctForm = false;
$bookAdded = false;

if (!empty($_POST)) {
    $correctTitle = Book::checkTitle($_POST["titre"]);
    $correctAuthor = Book::checkYear($_POST["auteur"]);
    $correctCategory = Book::checkYear($_POST["categorie"]);
    $correctYear = Book::checkYear((int)$_POST["year"]);
    $correctISBN = Book::checkISBN($_POST["isbn"]);
    $correctSynopsis = Book::checkSynopsis($_POST["synopsis"]);
}

if ($correctTitle == true && 
    $correctCategory == true && 
    $correctYear == true && 
    $correctISBN == true && 
    $correctSynopsis == true) {
        $correctForm = true;
    }

if ($correctForm == true) {
    Book::addBook($_POST["titre"], $_POST["auteur"], $_POST["categorie"], $_POST["year"], $_POST["isbn"], "1", $_POST["synopsis"], "0");
    $bookAdded = true;
}

echo $twig->render("add_book.html.twig", [
    "page_title" => "Bibliothèque - Ajouter un Livre",
    "authors" => Author::getAllAuthors(),
    "categories" => Category::getAllCategories(),
    "correctTitle" => $correctTitle,
    "correctAuthor" => $correctAuthor,
    "correctCategory" => $correctCategory,
    "correctYear" => $correctYear,
    "correctISBN" => $correctISBN,
    "correctSynopsis" => $correctSynopsis,
    "bookAdded" => $bookAdded
    ]);
    
// echo "<pre>";
// var_dump(Book::addBook($_POST["titre"], $_POST["auteur"], $_POST["categorie"], $_POST["year"], $_POST["isbn"], "1", $_POST["synopsis"], "0"));
// var_dump($_POST);
// var_dump($correctTitle);
// var_dump($correctAuthor);
// var_dump($correctCategory);
// var_dump($correctYear);
// var_dump($correctISBN);
// var_dump($correctSynopsis);
// var_dump($correctForm);
// echo "</pre>";

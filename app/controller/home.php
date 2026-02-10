<?php
session_start();
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";
use App\model\Book;

if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = $_GET['page'];
}else{
    $currentPage = 1;
}

if(isset($_GET['userSearch']) && !empty($_GET['userSearch'])){
    $userSearch = $_GET['userSearch'];
}else{
    $userSearch = "";
}

// Nombre de livres par pages
$byPages = 16;
$firstBook = ceil($currentPage * $byPages) - $byPages;

echo $twig->render("home.html.twig", [
    "page_title" => "Bibliothèque - Home",
    "books" => Book::getPageBooks($firstBook, $byPages, $userSearch),
    "currentPage" => $currentPage,
    "previousPage" => $currentPage - 1,
    "nextPage" => $currentPage + 1,
    "totalPages" => Book::getTotalPages($byPages, $userSearch),
    "userSearch" => $userSearch
]);
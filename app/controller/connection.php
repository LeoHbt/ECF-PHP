<?php
session_start();
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";

echo $twig->render("connection.html.twig", [
    "page_title" => "Bibliothèque - Connection",
    "error" => $_SESSION["error"]
]);
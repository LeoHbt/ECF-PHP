<?php
session_start();
use App\model\Book;
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";

Book::updateLike($id);
header("Location: /");
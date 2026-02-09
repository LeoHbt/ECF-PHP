<?php
session_start();
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "twig.php";
use App\model\User;

$user = new User($_POST["login"], $_POST["password"]);

if (!$user->userExist()) {
    $_SESSION["error"] = "Login incorrect"; 
    header("Location: /connexion");
} else if (!$user->passwordCorrect()) {
    $_SESSION["error"] = "Mot de passe incorrect";
    header("Location: /connexion");
} else {
    $_SESSION["connected"] = true;
    $_SESSION["user"] = $user->getUsername();
    $user->setRole();
    $_SESSION["role"] = $user->getRole();
    header("Location: /");
}
<?php
namespace App\model;
use App\model\Database;

use PDO;
use PDOException;

class User {
    private string $username;
    private string $password;
    private string $role;

    public function test() 
    {
        var_dump(Database::class);
    }

    public function __construct(string $username, string $password) 
    {
        $this->username = $username;
        $this->password = $password;
    }

    // Vérifie si le nom d'utilisateur existe dans la db
    public function userExist(): bool|PDOException
    {
        try {
           $database = Database::getInstance();
            $instance = $database->getConnection();
            $stmt = $instance->prepare(
                "SELECT 1 FROM `users` WHERE `username` = :username"
            );
            $stmt->execute(["username" => $this->username]);
            $response = $stmt->fetch();
            return (is_array($response)) ? true : false;
        } catch (PDOException $e) {
            return $e;
        }
        
    }

    // Vérifie si le mdp objet correspond avec le mdp de la db 
    public function passwordCorrect(): bool|PDOException
    {
        try {
           $database = Database::getInstance();
            $instance = $database->getConnection();
            $stmt = $instance->prepare(
                "SELECT `password` FROM `users` WHERE `username` = :username"
            );
            $stmt->execute(["username" => $this->username]);
            $response = $stmt->fetch(PDO::FETCH_ASSOC);
            return (password_verify($this->password, $response["password"])) ? true : false;
        } catch (PDOException $e) {
            return $e;
        }
        
    }
 
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
 
    public function getRole()
    {
        return $this->role;
    }

    public function setRole()
    {
        try {
           $database = Database::getInstance();
            $instance = $database->getConnection();
            $stmt = $instance->prepare(
                "SELECT `role` FROM `users` WHERE `username` = :username"
            );
            $stmt->execute(["username" => $this->username]);
            $response = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->role = $response["role"];
        } catch (PDOException $e) {
            return $e;
        }
    }
}
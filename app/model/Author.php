<?php
namespace App\model;
use App\model\Database;
use PDO;
use PDOException;

class Author {
    public int $id;
    public string $nom;
    public string $prenom;
    public string $biographie;

    static function getAllAuthors()
    {
        try {
           $database = Database::getInstance();
            $instance = $database->getConnection();
            $stmt = $instance->prepare(
                "SELECT *
                FROM `auteurs`
                ORDER BY `prenom`"
            );
            $stmt->execute();
            $response = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
            return $response;
        } catch (PDOException $e) {
            return $e;
        }
    }
}
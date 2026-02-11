<?php
namespace App\model;
use App\model\Database;
use PDO;
use PDOException;

class Category {
    public int $id;
    public string $nom;

    static function getAllCategories()
    {
        try {
           $database = Database::getInstance();
            $instance = $database->getConnection();
            $stmt = $instance->prepare(
                "SELECT *
                FROM `categories`
                ORDER BY `id`"
            );
            $stmt->execute();
            $response = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
            return $response;
        } catch (PDOException $e) {
            return $e;
        }
    }
}
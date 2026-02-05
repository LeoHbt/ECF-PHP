<?php
namespace App\model;
require_once(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "db_param.php");
use PDO;
use PDOException;

class Database {
    private static ?Database $instance = null;
    private PDO $connection;

    private string $host = DB_HOST;
    private string $dbname = DB_NAME;
    private string $username = DB_USER;
    private string $password = DB_PASS;
    private array $options = DB_OPTIONS;

    private function __construct()
    {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password,
                $this->options
            );
        } catch (PDOException $e) {
            exit("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database;
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
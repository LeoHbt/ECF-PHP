<?php
namespace App\model;
use App\model\Database;
use PDO;
use PDOException;

class Book {
    private int $id;
    private string $titre;
    private int $authorID;
    private int $categoryID;
    private int $year;
    private string $isbn;
    private bool $available;
    private string $synopsis;
    private bool $like;

    public function __construct(int $id = 0, string $titre = "", int $authorID = 0, int $categoryID = 0, int $year = 0, string $isbn = "", bool $available = false, string $synopsis = "", bool $like = false)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->authorID = $authorID;
        $this->categoryID = $categoryID;
        $this->year = $year;
        $this->isbn = $isbn;
        $this->available = $available;
        $this->synopsis = $synopsis;
        $this->like = $like;
    }

    static function getAllBooks()
    {
        try {
           $database = Database::getInstance();
            $instance = $database->getConnection();
            $stmt = $instance->prepare(
                "SELECT l.id, `titre`, `annee_publication`, `disponible`, `synopsis`, `like`, a.nom AS auteurNom,`prenom`, c.nom AS categorieNom
                FROM `livres` l 
                INNER JOIN `auteurs` a ON l.auteur_id = a.id
                INNER JOIN `categories` c ON l.categorie_id = c.id
                ORDER BY l.id"
            );
            $stmt->execute();
            $response = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
            return $response;
        } catch (PDOException $e) {
            return $e;
        }
    }

    static function getPageBooks(int $firstBook, int $byPages, string $userString = "")
    {
        try {
            $database = Database::getInstance();
            $instance = $database->getConnection();
            $stmt = $instance->prepare(
                "SELECT l.id, `titre`, `annee_publication`, `disponible`, `synopsis`, `like`, a.nom AS auteurNom,`prenom`, c.nom AS categorieNom
                FROM `livres` l 
                INNER JOIN `auteurs` a ON l.auteur_id = a.id
                INNER JOIN `categories` c ON l.categorie_id = c.id
                WHERE `titre` LIKE :userString
                ORDER BY l.id
                LIMIT :firstBook, :byPages"
            );
            $stmt->bindValue(":firstBook", $firstBook, PDO::PARAM_INT);
            $stmt->bindValue(":byPages", $byPages, PDO::PARAM_INT);
            $stmt->bindValue(":userString", "%" . $userString . "%", PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return $e;
        }
    }

    static function getNumberBooks(string $userString = "")
    {
        try {
            $database = Database::getInstance();
            $instance = $database->getConnection();
            $stmt = $instance->prepare(
                "SELECT COUNT(*) AS nb_books 
                FROM `livres`
                WHERE `titre` LIKE :userString"
            );
            $stmt->bindValue(":userString", "%" . $userString . "%", PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result["nb_books"];
        } catch (PDOException $e) {
            return $e;
        }
    }

    static function getTotalPages(int $articlesByPages, string $userString = "")
    {
        return floor(Book::getNumberBooks($userString) / $articlesByPages);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuthorID()
    {
        return $this->authorID;
    }

    public function setAuthorID($authorID)
    {
        $this->authorID = $authorID;

        return $this;
    }
 
    public function getCategoryID()
    {
        return $this->categoryID;
    }

    public function setCategoryID($categoryID)
    {
        $this->categoryID = $categoryID;

        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getAvailable()
    {
        return $this->available;
    }

    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    public function getSynopsis()
    {
        return $this->synopsis;
    }

    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getLike()
    {
        return $this->like;
    }

    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }
}
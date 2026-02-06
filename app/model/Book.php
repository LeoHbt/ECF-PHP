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
                "SELECT `titre`, `annee_publication`, `disponible`, `synopsis`, `like`, a.nom AS auteurNom,`prenom`, c.nom AS categorieNom
                FROM `livres` 
                NATURAL JOIN `auteurs` AS a, `categories` AS c"
            );
            $stmt->execute();
            $response = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
            return $response;
        } catch (PDOException $e) {
            return $e;
        }
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
<?php

namespace App\Model;

use PDO;

class LandscapeManager extends AbstractManager
{
    public const TABLE = 'landscape';

    public function insert($title, $description, $picture = null)
    {
        $query = "INSERT INTO " . self::TABLE . " (title, description, picture_link) 
        VALUES (:title,:description,:picture)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':picture', $picture);
        $statement->execute();
    }
}

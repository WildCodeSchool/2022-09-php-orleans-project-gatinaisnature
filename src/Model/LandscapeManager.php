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

    public function update($landscape, $picture = '')
    {
        $query = " SET `title` = :title,
          `description` = :description,
            `picture_link` = :picture WHERE id=:id";
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . $query);
        $statement->bindValue('id', $landscape['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $landscape['title'], PDO::PARAM_STR);
        $statement->bindValue('description', $landscape['description'], PDO::PARAM_STR);
        $statement->bindValue('picture', $picture, PDO::PARAM_STR);
        return $statement->execute();
    }
}

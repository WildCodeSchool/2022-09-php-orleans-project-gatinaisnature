<?php

namespace App\Model;

use PDO;

class RaceManager extends AbstractManager
{
    public const TABLE = 'race';

    /**
     * Insert new item in database
     */
    public function insert(string $name, string $link, string $picture): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`,
         `link`, `picture`) VALUES (:name, :link, :picture)");
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':link', $link, PDO::PARAM_STR);
        $statement->bindValue(':picture', $picture, PDO::PARAM_STR);

        $statement->execute();
    }
}

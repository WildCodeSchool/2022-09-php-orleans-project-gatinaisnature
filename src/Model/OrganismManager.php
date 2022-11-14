<?php

namespace App\Model;

use PDO;

class OrganismManager extends AbstractManager
{
    public const TABLE = 'organism';

    public function insert(string $name, string $link, string $picture): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (
            `name`,
            `link`,
            `picture`
        ) VALUES (:name, :link, :picture)");
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':link', $link, PDO::PARAM_STR);
        $statement->bindValue(':picture', $picture, PDO::PARAM_STR);

        $statement->execute();
    }

    public function update(array $organism): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET 
        `title` = :title,
        `link` = :link,
        `picture` = :picture
        WHERE id=:id");
        $statement->bindValue(':name', $organism['name'], PDO::PARAM_STR);
        $statement->bindValue(':link', $organism['link'], PDO::PARAM_STR);
        $statement->bindValue(':picture', $organism['picture'], PDO::PARAM_STR);
        return $statement->execute();
    }
}

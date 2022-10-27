<?php

namespace App\Model;

use PDO;

class EventManager extends AbstractManager
{
    public const TABLE = 'event';


    /**
     * Get all rows from db having  date time in specific format.
     */
    public function selectEventsDateDetails(): array
    {
        $query = 'SELECT title,cost,description,date
        FROM ' . self::TABLE . '
        ORDER BY date DESC LIMIT 3';

        return $this->pdo->query($query)->fetchAll();
    }





    /**
     * Insert new item in database
     */



    public function insert(array $item): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */



    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        return $statement->execute();
    }
}

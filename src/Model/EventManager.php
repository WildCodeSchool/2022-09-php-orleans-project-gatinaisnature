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
        $query = 'SELECT title,cost,picture_link,description,date
        FROM ' . self::TABLE . '
        ORDER BY date DESC';

        return $this->pdo->query($query)->fetchAll();
    }

    /**
     * Update activity in database
     */
    public function update($event, $picture = '')
    {
        $query = " SET `title` = :title,
         `date` = :date,
          `description` = :description,
           `cost` = :cost,
            `picture` = :picture WHERE id=:id";
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . $query);
        $statement->bindValue('id', $event['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $event['title'], PDO::PARAM_STR);
        $statement->bindValue('date', $event['date'], PDO::PARAM_STR);
        $statement->bindValue('description', $event['description'], PDO::PARAM_STR);
        $statement->bindValue('cost', $event['cost'], PDO::PARAM_STR);
        $statement->bindValue('picture', $picture, PDO::PARAM_STR);
        return $statement->execute();
    }
}

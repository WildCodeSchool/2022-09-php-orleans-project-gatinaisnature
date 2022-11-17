<?php

namespace App\Model;

use PDO;

class EventManager extends AbstractManager
{
    public const TABLE = 'event';


    public function selectEventsDateDetails(): array
    {
        $query = 'SELECT title,cost,picture,description,date
        FROM ' . self::TABLE . '
        ORDER BY date DESC';

        return $this->pdo->query($query)->fetchAll();
    }

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

    public function insert($event, $picture = null)
    {
        $query = "INSERT INTO " . self::TABLE . " (`title`,`date`,`description`,`cost`,`picture`) 
        VALUES (:title,:date,:description,:cost,:picture)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $event['title']);
        $statement->bindValue(':date', $event['date']);
        $statement->bindValue(':description', $event['description']);
        $statement->bindValue(':cost', $event['cost']);
        $statement->bindValue(':picture', $picture);
        $statement->execute();
    }
}

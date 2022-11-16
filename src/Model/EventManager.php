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

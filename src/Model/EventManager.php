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
}

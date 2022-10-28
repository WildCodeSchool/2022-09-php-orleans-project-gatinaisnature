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
}

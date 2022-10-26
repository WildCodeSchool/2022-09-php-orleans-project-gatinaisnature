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
        $query = 'SELECT title,cost,description,
        CASE
            WHEN DATE_FORMAT(date,"%W") = "Monday" THEN "Lundi"
            WHEN DATE_FORMAT(date,"%W") = "Tuesday" THEN "Mardi"
            WHEN DATE_FORMAT(date,"%W") = "Wednesday" THEN "Mercredi"
            WHEN DATE_FORMAT(date,"%W") = "Thursday" THEN "Jeudi"
            WHEN DATE_FORMAT(date,"%W") = "Friday" THEN "Vendredi"
            WHEN DATE_FORMAT(date,"%W") = "Saturday" THEN "Samedi"
            WHEN DATE_FORMAT(date,"%W") = "Sunday" THEN "Dimanche"
            ELSE "issue on date in dataset"
            END AS dayOfWeek,
        DATE_FORMAT(date,"%e") AS day,
        CASE
            WHEN DATE_FORMAT(date,"%M") = "January" THEN "Janvier"
            WHEN DATE_FORMAT(date,"%M") = "February" THEN "Fevrier"
            WHEN DATE_FORMAT(date,"%M") = "March" THEN "Mars"
            WHEN DATE_FORMAT(date,"%M") = "April" THEN "Avril"
            WHEN DATE_FORMAT(date,"%M") = "May" THEN "Mai"
            WHEN DATE_FORMAT(date,"%M") = "June" THEN "Juin"
            WHEN DATE_FORMAT(date,"%M") = "July" THEN "Juillet"
            WHEN DATE_FORMAT(date,"%M") = "August" THEN "Aout"
            WHEN DATE_FORMAT(date,"%M") = "September" THEN "Septembre"
            WHEN DATE_FORMAT(date,"%M") = "October" THEN "Octobre"
            WHEN DATE_FORMAT(date,"%M") = "November" THEN "Novembre"
            WHEN DATE_FORMAT(date,"%M") = "December" THEN "Décembre"
            ELSE "issue on date in dataset"
            END AS month,
        DATE_FORMAT(date,"%Y") AS year
        FROM ' . static::TABLE . '
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

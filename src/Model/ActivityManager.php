<?php

namespace App\Model;

use PDO;

class ActivityManager extends AbstractManager
{
    public const TABLE = 'activity';

    public function insert($title, $description, $picture = null)
    {
        $query = "INSERT INTO `activity` (`title`,`description`,`picture`) 
        VALUES (:title,:description,:picture)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':picture', $picture);
        $statement->execute();
    }
        /**
     * Update activity in database
     */
    public function update($activity, $picture = '')
    {
        $query = " SET `title` = :title, `description` = :description, `picture` = :picture WHERE id=:id";
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . $query);
        $statement->bindValue('id', $activity['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $activity['title'], PDO::PARAM_STR);
        $statement->bindValue('description', $activity['description'], PDO::PARAM_STR);
        $statement->bindValue('picture', $picture, PDO::PARAM_STR);
        return $statement->execute();
    }
}

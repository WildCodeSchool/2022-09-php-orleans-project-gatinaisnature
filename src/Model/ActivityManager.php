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
}

<?php

namespace App\Model;

use PDO;

class CircuitManager extends AbstractManager
{
    public const TABLE = 'circuit';

    public function updateCircuit(array $circuit, $picture)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET `title` = :title, `size` = :size, `content` = :content, `map` = :map, `trace` = :trace, `picture` = :picture 
        WHERE id=:id");
        $statement->bindValue('id', $circuit['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $circuit['title'], PDO::PARAM_STR);
        $statement->bindValue('size', $circuit['size'], PDO::PARAM_STR);
        $statement->bindValue('content', $circuit['content'], PDO::PARAM_STR);
        $statement->bindValue('map', $circuit['map'], PDO::PARAM_STR);
        $statement->bindValue('trace', $circuit['trace'], PDO::PARAM_STR);
        $statement->bindValue('picture', $picture, PDO::PARAM_STR);
        return $statement->execute();
    }
}

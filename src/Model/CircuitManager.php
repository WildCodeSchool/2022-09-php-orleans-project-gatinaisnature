<?php

namespace App\Model;

use PDO;

class CircuitManager extends AbstractManager
{
    public const TABLE = 'circuit';

    public function save($circuit, $picture): void
    {
        $query = "INSERT INTO circuit (`title`, `size`, `content`, `map`, `trace`, `picture`)
        VALUES (:title, :size, :content, :map, :trace, :picture)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('title', $circuit['title'], \PDO::PARAM_STR);
        $statement->bindValue('size', $circuit['size'], \PDO::PARAM_STR);
        $statement->bindValue('content', $circuit['content'], \PDO::PARAM_STR);
        $statement->bindValue('map', $circuit['map'], \PDO::PARAM_STR);
        $statement->bindValue('trace', $circuit['trace'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $picture, \PDO::PARAM_STR);
        $statement->execute();
    }
}

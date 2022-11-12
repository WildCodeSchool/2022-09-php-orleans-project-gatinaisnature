<?php

namespace App\Model;

use PDO;

class CircuitManager extends AbstractManager
{
    public const TABLE = 'circuit';

    public function save($title, $size, $content, $map, $trace, $picture): void
    {
        $query = "INSERT INTO circuit (`title`, `size`, `content`, `map`, `trace`, `picture`)
        VALUES (:title, :size, :content, :map, :trace, :picture)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('title', $title, \PDO::PARAM_STR);
        $statement->bindValue('size', $size, \PDO::PARAM_STR);
        $statement->bindValue('content', $content, \PDO::PARAM_STR);
        $statement->bindValue('map', $map, \PDO::PARAM_STR);
        $statement->bindValue('trace', $trace, \PDO::PARAM_STR);
        $statement->bindValue('picture', $picture, \PDO::PARAM_STR);
        $statement->execute();
    }
}

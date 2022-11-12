<?php

namespace App\Model;

use PDO;

class CircuitManager extends AbstractManager
{
    public const TABLE = 'circuit';

    public function updateCircuit(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET `title`, `size`, `content`, `map`, `trace`, `picture` = :title, :size, :content, :map, :trace, :picture WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);
        $statement->bindValue('size', $item['size'], PDO::PARAM_STR);
        $statement->bindValue('content', $item['content'], PDO::PARAM_STR);
        $statement->bindValue('map', $item['map'], PDO::PARAM_STR);
        $statement->bindValue('trace', $item['trace'], PDO::PARAM_STR);
        $statement->bindValue('picture', $item['picture'], PDO::PARAM_STR);
        return $statement->execute();
    }
}

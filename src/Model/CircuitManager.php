<?php

namespace App\Model;

use PDO;

class CircuitManager extends AbstractManager
{
    public const TABLE = 'circuit';

    public function saveCircuit($circuit, $picture): void
    {
        $query = "INSERT INTO circuit (`title`, `size`, `content`, `trace`, `picture`)
        VALUES (:title, :size, :content, :trace, :picture)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('title', $circuit['title'], \PDO::PARAM_STR);
        $statement->bindValue('size', $circuit['size'], \PDO::PARAM_STR);
        $statement->bindValue('content', $circuit['content'], \PDO::PARAM_STR);
        $statement->bindValue('trace', $circuit['trace'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $picture, \PDO::PARAM_STR);
        $statement->execute();
    }

    public function selectLastId()
    {
        $query = "SELECT MAX(id) AS id FROM circuit";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetch();
    }

    public function updateCircuit(array $circuit, int $id, $picture)
    {
        $query = " SET `title` = :title, `size` = :size, `content` = :content,
        `trace` = :trace, `picture` = :picture WHERE id=:id";
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . $query);
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->bindValue('title', $circuit['title'], \PDO::PARAM_STR);
        $statement->bindValue('size', $circuit['size'], \PDO::PARAM_STR);
        $statement->bindValue('content', $circuit['content'], \PDO::PARAM_STR);
        $statement->bindValue('trace', $circuit['trace'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $picture, \PDO::PARAM_STR);
        return $statement->execute();
    }

    public function saveCircuitOrganism($circuitId, $organismIds): void
    {
        foreach ($organismIds as $organismId) {
            $query = "INSERT INTO circuit_organism (`circuit_id`, `organism_id`)
            VALUES (:circuit_id, :organism_id)";
            $statement = $this->pdo->prepare($query);
            $statement->bindValue('circuit_id', $circuitId);
            $statement->bindValue('organism_id', $organismId);
            $statement->execute();
        }
    }

    public function deleteCircuitOrganism($circuitId)
    {
        $query = "DELETE FROM circuit_organism WHERE `circuit_id` = :circuit_id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('circuit_id', $circuitId, \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function saveCircuitLandscape($circuitId, $landscapeIds): void
    {
        foreach ($landscapeIds as $landscapeId) {
            $query = "INSERT INTO circuit_landscape (`circuit_id`, `landscape_id`)
            VALUES (:circuit_id, :landscape_id)";
            $statement = $this->pdo->prepare($query);
            $statement->bindValue('circuit_id', $circuitId);
            $statement->bindValue('landscape_id', $landscapeId);
            $statement->execute();
        }
    }

    public function deleteCircuitLandscape($circuitId)
    {
        $query = "DELETE FROM circuit_landscape WHERE `circuit_id` = :circuit_id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('circuit_id', $circuitId, \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function selectOrganisms($id)
    {
        $query = "SELECT o.name, o.link, o.picture FROM organism o 
        JOIN circuit_organism co ON co.organism_id = o.id
        JOIN circuit c ON co.circuit_id = c.id WHERE c.id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectLandscapes($id)
    {
        $query = "SELECT l.title, l.description, l.picture_link FROM landscape l 
        JOIN circuit_landscape cl ON cl.landscape_id = l.id
        JOIN circuit c ON cl.circuit_id = c.id WHERE c.id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}

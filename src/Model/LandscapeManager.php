<?php

namespace App\Model;

use PDO;

class LandscapeManager extends AbstractManager
{
    public const TABLE = 'landscape';


    public function getLandscapeByCircuit(int $circuitId): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE circuit_id=:circuit_id");
        $statement->bindValue('circuit_id', $circuitId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}

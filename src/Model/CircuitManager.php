<?php

namespace App\Model;

use PDO;

class CircuitManager extends AbstractManager
{
    public const TABLE = 'circuit';

    public function save(array $circuit): void
    {
        $query = 'INSERT INTO circuit(title, size, content, map, trace/* , picture_circuit */) VALUES (:title, :size, :content, :map, :trace/* , :picture_circuit */)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $circuit['title'], \PDO::PARAM_STR);
        $statement->bindValue(':size', $circuit['size'], \PDO::PARAM_STR);
        $statement->bindValue(':content', $circuit['content'], \PDO::PARAM_STR);
        $statement->bindValue(':map', $circuit['map'], \PDO::PARAM_STR);
        $statement->bindValue(':trace', $circuit['trace'], \PDO::PARAM_STR);
        /* $statement->bindValue(':picture_circuit', $circuit['picture_circuit'], \PDO::PARAM_LOB); */
        $statement->execute();
    }
}


/* <?php

namespace App\Models;

class RecipeModel
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = new \PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
    }

    public function getAll(): array|bool
    {
        $statement = $this->connection->query('SELECT id, title FROM recipe');
        $recipes = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $recipes;
    }

    public function getById(int $id): array|bool
    {
        $query = 'SELECT title, description, id FROM recipe WHERE id=:id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $recipe = $statement->fetch(\PDO::FETCH_ASSOC);

        return $recipe;
    }

    public function save(array $recipe): void
    {
        $query = 'INSERT INTO recipe(title, description) VALUES (:title, :description)';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':title', $recipe['title'], \PDO::PARAM_STR);
        $statement->bindValue(':description', $recipe['description'], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete(int $id): void
    {
        $query = 'DELETE FROM recipe WHERE id=:id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function update(array $recipe, $id): void
    {
        $query = 'UPDATE recipe SET title=:title, description=:description WHERE id=:id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':title', $recipe['title'], \PDO::PARAM_STR);
        $statement->bindValue(':description', $recipe['description'], \PDO::PARAM_STR);
        $statement->bindValue(':id', $id, \PDO::PARAM_STR);
        $statement->execute();
    }
} */
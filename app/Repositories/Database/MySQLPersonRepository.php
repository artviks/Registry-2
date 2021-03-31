<?php

namespace App\Repositories\Database;

use App\Repositories\PersonRepository;
use App\Models\{Person, PersonCollection};
use PDO;

class MySQLPersonRepository implements PersonRepository
{
    private PDO $pdo;
    private string $table = 'persons';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll(): PersonCollection
    {
        $sql = "select * from $this->table";

        return $this->getPersonCollection($sql);
    }

    public function add(Person $person): void
    {
        $sql = sprintf(
            "insert into $this->table (
                   name, surname, code, description)
                    values ('%s', '%s', '%s', '%s')",
            $person->name(),
            $person->surname(),
            $person->code(),
            $person->description()
        );

        $this->pdo->exec($sql);
    }

    public function findPersonBy(string $condition): PersonCollection
    {
        $sql = "select * from $this->table where '$condition' in (name, surname, code)";

        return $this->getPersonCollection($sql);
    }

    public function updateDescription(string $description, int $id): void
    {
        $sql = "update $this->table set 
                 description = '$description' where id = $id";

        $this->pdo->exec($sql);
    }

    private function getPersonCollection(string $sql): PersonCollection
    {
        $statement = $this->pdo->query($sql);
        $persons = $statement->fetchAll(PDO::FETCH_ASSOC);

        $col = new PersonCollection();
        foreach ($persons as $person)
        {
            $p = new Person($person['name'], $person['surname'], $person['code'], $person['description']);
            $p->setId($person['id']);
            $col->add($p);
        }

        return $col;
    }
}
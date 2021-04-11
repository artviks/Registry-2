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
                   name, surname, code, age, address, description)
                    values ('%s', '%s', '%s', %s, '%s', '%s')",
            $person->name(),
            $person->surname(),
            $person->code(),
            $person->age(),
            $person->address(),
            $person->description()
        );

        $this->pdo->exec($sql);
    }

    public function findPersonBy(string $condition): ?PersonCollection
    {
        $sql = "select * from $this->table where '$condition' in (name, surname, code)";

        return $this->getPersonCollection($sql);
    }

    public function findPersonById(int $id): Person
    {
        $sql = "select * from $this->table where id = $id";
        $statement = $this->pdo->query($sql);
        $person = $statement->fetch();

        return $this->setPerson($person);
    }

    public function update(int $id, int $age, string $address, string $description): void
    {
        $sql = "update $this->table
                set age = $age, address = '$address', description = '$description'
                where id = $id";

        $this->pdo->exec($sql);
    }


    private function getPersonCollection(string $sql): ?PersonCollection
    {
        $statement = $this->pdo->query($sql);
        $persons = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (empty($persons))
        {
            return null;
        }

        $col = new PersonCollection();
        foreach ($persons as $person)
        {
            $col->add($this->setPerson($person));
        }

        return $col;
    }

    private function setPerson(array $person): Person
    {
        $p = new Person(
            $person['name'],
            $person['surname'],
            $person['code'],
            $person['age'],
            $person['address'],
            $person['description'],
        );
        $p->setId($person['id']);

        return $p;
    }
}
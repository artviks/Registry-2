<?php

namespace Tests\Unit;

use App\Models\Person;
use App\Models\PersonCollection;
use PHPUnit\Framework\TestCase;

class PersonCollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $persons = new PersonCollection();
        $persons->add(new Person('A', 'B', '112233-12345', 'Cool'));

        self::assertCount(1, $persons->collection());
        self::assertInstanceOf(Person::class, $persons->collection()[0]);
    }

    public function testAddMany(): void
    {
        $persons = new PersonCollection();
        $persons->add(new Person('A', 'B', '112233-12345', 'Cool'));
        $persons->add(new Person('A', 'B', '112233-12345', 'Cool'));
        $persons->add(new Person('A', 'B', '112233-12345', 'Cool'));

        self::assertCount(3, $persons->collection());
    }
}
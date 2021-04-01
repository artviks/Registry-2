<?php require 'Partials/header.php' ?>

    <h2>SEARCH</h2>

    <p>Search in registry by name, surname, personal code, age or address:</p>
    <form method="GET" action="/searchPerson">
        <input type="text" name="condition">
    </form>

<?php if(isset($persons)){ ?>
    <br>
    <table>
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Personal Code</th>
        <th>Age</th>
        <th>Address</th>
        <th>Description</th>
    </tr>
    <?php foreach ($persons->collection() as $person) :?>
        <tr>
            <td><?= $person->name() ?></td>
            <td><?= $person->surname() ?></td>
            <td><?= $person->code() ?></td>
            <td><?= $person->age() ?></td>
            <td><?= $person->address() ?></td>
            <td><?= $person->description() ?></td>
            <td>
                <form method="GET" action="/edit">
                    <input type="hidden" name="id" value=<?= $person->id() ?>>
                    <input type="submit" value="Edit">
                </form>
            </td>
        </tr>
    <?php endforeach;} ?>
    </table>

<?php require 'Partials/footer.php' ?>
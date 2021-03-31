<?php require 'Partials/header.php' ?>

<h2>HOME</h2>

<p>Welcome to Registry!</p>
<br>
<p>Search in registry by name, surname or personal code:</p>
<form method="GET" action="/search">
    <input type="text" name="condition">
</form>

<?php if(isset($persons)){ ?>
    <br>
    <table>
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Personal Code</th>
        <th>Description</th>
    </tr>
    <?php foreach ($persons->collection() as $person) :?>
        <tr>
            <td><?= $person->name() ?></td>
            <td><?= $person->surname() ?></td>
            <td><?= $person->code() ?></td>
            <td><?= $person->description() ?>
                <form method="POST" action="/description">
                    <input type="text" name=<?= $person->id() ?>>
                </form>
            </td>
        </tr>
    <?php endforeach;} ?>
    </table>

<?php require 'Partials/footer.php' ?>
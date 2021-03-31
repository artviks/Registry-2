<?php require 'Partials/header.php' ?>

<h2>DATA</h2>

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
        <td><?= $person->description() ?></td>
    </tr>
<?php endforeach; ?>
</table>

<br>
<h4>Here you can add to registry:</h4>
<form method="POST" action="/data">
    <label for="name">Name:</label>
    <br>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="surname">Surname:</label>
    <br>
    <input type="text" id="surname" name="surname" required>
    <br>
    <label for="code">Personal Code:</label>
    <br>
    <input type="text" id="code" name="code" required>
<!--           pattern="" title="Use correct form"-->

    <br>
    <label for="description">Description:</label>
    <br>
    <input type="text" id="description" name="description">
    <br>
    <br>
    <input type="submit" value="Submit">
</form>

<?php require 'Partials/footer.php' ?>
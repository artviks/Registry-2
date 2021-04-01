<?php require 'Partials/header.php' ?>

<h2>EDIT</h2>

<p>Name:  <?=$person->name()?></p>
<p>Surname:  <?=$person->surname()?></p>
<p>Personal code:  <?=$person->code()?></p>

<form method="POST" action="/update">

    <input type="hidden" name="id" value=<?= $person->id() ?>>

    <label for="age">Age:</label>
    <input type="text" id="age" name="age" value=<?=$person->age()?>>
    <br><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value=<?=$person->address()?>>
    <br><br>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" value=<?=$person->description()?>>
    <br><br>

    <br>

    <input type="submit" value="Update">
</form>

<?php require 'Partials/footer.php' ?>

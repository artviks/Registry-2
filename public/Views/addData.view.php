<?php require 'Partials/header.php' ?>

<h2>ADD</h2>

<p>Here you can add new persons to registry:</p>
<form method="POST" action="/add">
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
    <input type="text" id="code" name="code" required
           pattern="(\d{6}[-]*\d{5})" title="Use correct form">
    <br>
    <label for="age">Age:</label>
    <br>
    <input type="text" id="age" name="age">
    <br>
    <label for="address">Address:</label>
    <br>
    <input type="text" id="address" name="address">
    <br>
    <label for="description">Description:</label>
    <br>
    <input type="text" id="description" name="description">
    <br>
    <br>
    <input type="submit" value="Add to Registry">
</form>

<?php require 'Partials/footer.php' ?>

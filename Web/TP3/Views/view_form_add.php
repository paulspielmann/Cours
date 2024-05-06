<?php
require "view_begin.php";
//require "Models/Model.php";
?>

<form action="?controller=set&action=add" method="post">
<label for="year">Year:</label><input type="text" name="year" required>
<label for="name">Name:</label><input type="text" name="name" required>
<label for="birthdate">Birth Date:</label><input type="text" name="birthdate">
<label for="birthplace">Birth Place:</label><input type="text" name="birthplace">
<label for="county">Country:</label><input type="text" name="county" >


<fieldset><legend> Select a category: </legend><p>
<?= $res?>
</p><textarea name="motivation" cols="70" rows="10"></textarea>
<input type="submit" value="Add in database"></form>
<?php require "view_end.php"; ?>
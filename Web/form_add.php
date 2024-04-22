<?php
require "begin.html";
require 'Model.php';
$m = Model::getModel();

echo '<form action="add.php" method="post">';
echo '<label for="year">Year:</label>' . '<input type="text" name="year" required>';
echo '<label for="name">Name:</label>' . '<input type="text" name="name" required>';
echo '<label for="birthdate">Birth Date:</label>' . '<input type="text" name="birthdate">';
echo '<label for="birthplace">Birth Place:</label>' . '<input type="text" name="birthplace">';
echo '<label for="county">Country:</label>' . '<input type="text" name="county" >';

$cat = $m->getCategories();
echo '<fieldset>' . '<legend> Select a category: </legend><p>';
foreach ($cat as $c) {
    echo '<div><input type="radio" name="category" value="' . $c[0] . '"/><label for="' . $c[0] . '">' . $c[0] . '</label></div>';
}
echo '</p><textarea name="motivation" cols="70" rows="10"></textarea>';
echo '<input type="submit" value="Add in database"></form>';

require "end.html"; ?>
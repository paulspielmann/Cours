<?php
require "begin.html";
require 'Model.php';
$m = Model::getModel();
$tab = $m->getLast(25);

echo '<table>';
echo '<tr><td><b> Name </td><td><b> Category </td><td><b> Year </td></tr>';
foreach ($tab as $line) {
    echo '<tr><td><a href="informations.php?id=' . $line['id'] . '">' .$line['name'] . '</td><td>' . $line['category'] . '</td><td>' . $line['year'] . '</td><td><a href="remove.php?id=' . $line['id'] .'"><img src="remove_icon.png"class=icon/></a></td></tr>';
}
echo '</table>';

require "end.html"; ?>
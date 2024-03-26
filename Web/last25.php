<?php
require "begin.html";
require 'Model.php';
$m = Model::getModel();
$tab = $m->getLast(25);

foreach ($tab as $line) {
    echo '<tr><td>' . $line['name'] . '</td><td>' . $line['category'] . '</td><td>' . $line['year'] . '</td></tr>';
}
require "end.html"; ?>
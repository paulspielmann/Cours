<?php
require "begin.html";
require 'Model.php';
$m = Model::getModel();

if (isset($_GET['id'])) {
    if (is_numeric($_GET['id']) && $_GET['id'] > 0) {
        $tab = $m->getNobelPrizeInfo($_GET['id']);
        if ($tab == Null) {
            echo "Pas de prix nobel associe a cet ID";
        }
        else {
            echo '<table>';
            foreach ($tab as $line) {
                echo '<tr>';
                foreach ($line as $cell) {
                    echo '<td>' . $cell .'</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        }
    }
}

require "end.html"; ?>
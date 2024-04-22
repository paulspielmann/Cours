<?php
require "begin.html";
require 'Model.php';
$m = Model::getModel();

if (isset($_GET["id"])) {
    if ($_GET["id"] > $m->getTotal() || $_GET["id"] < 0) {
        echo "There is no Nobel Prize associated to this ID.";
    } else {
        $m->removeNobelPrize($_GET["id"]);
        echo "Nobel prize has been removed.";
    }
} else {
    echo "There is no id in the url.";
}

require "end.html"; ?>
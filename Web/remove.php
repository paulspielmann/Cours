<?php
require "begin.html";
require 'Model.php';
$m = Model::getModel();

if (isset($_GET["id"])) {
    if (!$m->exists($_GET["id"])) {
        echo "There is no Nobel Prize associated to this ID.";
    } else {
        $m->removeNobelPrize($_GET["id"]);
        echo "Nobel prize has been removed.";
    }
} else {
    echo "There is no id in the url.";
}

require "end.html"; ?>
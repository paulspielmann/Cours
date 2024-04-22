<?php
require "begin.html";
require 'Model.php';
$m = Model::getModel();

// Check that the form has been submitted and with the correct method
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $r = $m->checkData();
    if ($r) {
        $m->addNobelPrize($r);
        echo 'Prix Nobel ajoute !';
        return true;
    } else {
        echo 'ERREUR !';
        return false;
    }
}

require "end.html"; ?>
<?php
require 'TODOList.php';

$maListe = new TODOList();

$maListe->add_to_do("TP de PHP 1");
$maListe->add_to_do("Aller chez LIDL");
$maListe->add_to_do("Rattraper le cours d'algebre du 8 mars");

echo $maListe->get_html();

require 'fin_code.php';
?>

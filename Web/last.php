<?php
require 'debut_code.php';

$bd = new PDO('pgsql:host=aquabdd;dbname=etudiants', '12316971', '081289083CB');
$bd->query("SET NAMES 'utf-8'");
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$req = $bd->prepare('SELECT * FROM nobels ORDER BY year DESC LIMIT 25;');
$req->execute();
echo "<table>";

/*
while ($line = $req->fetch()) {
    echo '<tr><td>' . $line['name'] . '</td><td>' . $line['category'] . '</td><td>' . $line['year'] . '</td></tr>';
}
*/

$tab = $req->fetchAll();
foreach ($tab as $line) {
    echo '<tr><td>' . $line['name'] . '</td><td>' . $line['category'] . '</td><td>' . $line['year'] . '</td></tr>';
}

echo "</table>";
require 'fin_code.php';
?>
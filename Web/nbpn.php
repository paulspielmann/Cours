<?php
require 'debut_code.php';

$bd = new PDO('pgsql:host=aquabdd;dbname=etudiants', '12316971', '081289083CB');
$bd->query("SET NAMES 'utf-8'");
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$req = $bd->prepare('SELECT count(*) FROM nobels');
$req->execute();
$ans = $req->fetch();

echo $ans['count'];

require 'fin_code.php';
?>
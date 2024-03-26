<?php
require 'debut_code.php';

$bd = new PDO('pgsql:host=aquabdd;dbname=etudiants', '12316971', '081289083CB');
$bd->query("SET NAMES 'utf-8'");
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (is_int($id) || $id > 0 || $id <= 839) {
        $req = $bd->prepare('SELECT * FROM nobels WHERE id = ' . $id);
    }
    else { 
        echo "Identifiant incorrect. Doit etre un nombre entier";
    }
} else {
    echo "Aucun identifiant.";
}

$req->execute();
$tab = $req->fetch(PDO::FETCH_ASSOC);
echo '<ul>';
foreach ($tab as $item) {
    echo '<li>' . $item . '</li>';
}
echo '</ul>';


require 'fin_code.php';
?>
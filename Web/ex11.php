<?php
require 'debut_code.php';
require 'TODOList.php';

session_start();

echo "<a href=\"http://localhost/~12316971/ex11.php?rmsess=1\">Supprimer session</a>";
echo "<a href=\"http://localhost/~12316971/ex11.php?save=1\">Sauvegarder cookie</a>";
echo "<form> Ajouter une tache : <input name=\"task\"type=text></form>";

if (!isset($_SESSION["td1"])) {
    $list = new TODOList();
    if (isset($_COOKIE['liste'])) {
        $_SESSION["td1"] = $list->set_representation($_COOKIE['liste']);
    } else {
    $_SESSION["td1"] = $list;
    }
} else {
    if (isset($_GET['task'])) {
        $_SESSION["td1"]->add_to_do($_GET['task']);
    }
    if (isset($_GET['rm'])) {
        $_SESSION["td1"]->remove_to_do($_GET['rm']);
    }
    if (isset($_GET['save'])) {
        setcookie('liste', $_SESSION["td1"]->get_representation(), time() + 30 * 24 * 3600, null, null, true, true);
    }
    if (isset($_GET['rmsess'])) {
        unset($_SESSION["td1"]);
    }
    echo $_SESSION["td1"]->get_html();
}

require 'fin_code.php';
?>
<?php
require 'debut_code.php';

session_start();
$nums = [];
setcookie("nums", "numsVal", time() + 60*60*24*30, null, null, true, true);
if (isset($_GET['num'])) {
	echo (preg_match("/^-?[0-9]+$/", $_GET['num']));
}
require 'fin_code.php';
?>
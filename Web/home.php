<?php
require "begin.html";
require 'Model.php';
$m = Model::getModel();
$total = $m->getTotal();

?>
<h1> List of the nobel prizes </h1>

<p> Welcome to the website listing the different nobel prizes given until 2010. 
    It references <strong><?= $total; ?></strong> nobel prizes. You can modify this list by adding new Nobel Prizes, and removing or updating the information contained in this database. You can also search among the nobel prizes on the name, the year and the different categories. </p>


<?php require "end.html"; ?>
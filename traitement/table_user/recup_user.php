<?php
include("../../app/utilisateur.php");
include("../../app/utilisateur_management.php");

$utilisateur_management = new utilisateur_management();
$utilisateur_management->getUserInHtml();

 ?>
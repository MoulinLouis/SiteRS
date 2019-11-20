<?php
// On fait appel au classe
include("../../app/postevent.php");
include("../../app/postevent_management.php");
// On stock la classe postevent_management dans $postevent_management
$postevent_management = new postevent_management();
// On fait appel à la fonction getEventInHtml qui retourne l'html du tableau
$postevent_management->getEventInHtml();

 ?>
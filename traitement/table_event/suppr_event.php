<?php
// On fait appel au classe
include("../../app/postevent.php");
include("../../app/postevent_management.php");
require_once('../../app/connexionpdo.php');

// On stock les valeurs envoyées en POST
$id = $_POST["id"];

// On stock dans $post l'objet postevent en indiquant le titre et le texte
$post = new postevent([
    'idpost' => $id,
]);
// On stock la classe postevent_management dans $postevent_management
$postevent_management = new postevent_management();
// On effectue la fonction deleteEvent en envoyant l'objet $post
$postevent_management->deleteEvent($post);
?>
<?php
// On fait appel au classe
include("../../app/postevent.php");
include("../../app/postevent_management.php");
require_once('../../app/connexionpdo.php');

// On stock les valeurs envoyées en POST
$id = $_POST["id"];
$text = $_POST["text"];
$colonne = $_POST["column_name"];

// On stock dans $post l'objet postevent en indiquant le titre et le texte
$post = new postevent([
	'idpost' => $id,
	'texte' => $text
]);

// On stock la classe postevent_management dans $postevent_management
$postevent_management = new postevent_management();
// On effectue la fonction editEvent en envoyant l'objet $post en paramètre ainsi que le nom de la colonne dans $colonne
$postevent_management->editEvent($post, $colonne);
?>


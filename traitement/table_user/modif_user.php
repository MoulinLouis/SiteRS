<?php
include("../../app/utilisateur.php");
include("../../app/utilisateur_management.php");
require_once('../../app/connexionpdo.php');

$id = $_POST["id"];
$text = $_POST["text"];
$colonne = $_POST["column_name"];

$utilisateur = new utilisateur([
	'iduser' => $id,
]);

$utilisateur_management = new utilisateur_management();
$utilisateur_management->editUser($utilisateur, 'admin', $text, $colonne);
?>


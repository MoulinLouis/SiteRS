<?php
include("../../app/utilisateur.php");
include("../../app/utilisateur_management.php");
require_once('../../app/connexionpdo.php');

$id = $_POST["id"];

$utilisateur = new utilisateur([
    'iduser' => $id,
]);

$utilisateur_management = new utilisateur_management();
$utilisateur_management->deleteUser($utilisateur);
 ?>
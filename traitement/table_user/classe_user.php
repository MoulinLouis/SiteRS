<?php
include("../../app/utilisateur.php");
include("../../app/utilisateur_management.php");

$id = $_POST['id'];
$classe = $_POST["classe"];

$utilisateur = new utilisateur([
    'iduser' => $id,
    'classe' => $classe
]);

$utilisateur_management = new utilisateur_management();
$utilisateur_management->attributeClasseUser($utilisateur);

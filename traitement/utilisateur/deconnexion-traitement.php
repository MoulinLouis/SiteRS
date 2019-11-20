<?php
// On démarre les sessions
session_start();
// On fait appel aux classes
require_once('../../app/utilisateur.php');
require_once('../../app/utilisateur_management.php');
// On stock la classe utilisateur_management dans $utilisateur_management
$utilisateur_management = new utilisateur_management();
// On effectue la fonction disconnectUser
$utilisateur_management->disconnectUser();
?>
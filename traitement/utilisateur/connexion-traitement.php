<?php
// On démarre les sessions
session_start();
// On fait appel aux classes
require_once('../../app/utilisateur.php');
require_once('../../app/utilisateur_management.php');
// Si un des champs est vide on affiche un erreur
if(empty($_POST['email']) || empty($_POST['mdp'])) {
    getError("Veuillez remplir tous les champs", "../../connexion.php");
} else {
    // On stock les valeurs envoyées en POST
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    // On stock dans l'objet utilisateur les infos de l'utilisateur
    $user = new utilisateur([
        'email' => $email,
        'mdp' => $mdp
    ]);
    // On stock la classe utilisateur_management dans $utilisateur_management
    $utilisateur_management = new utilisateur_management();
    // On effectue la fonction loginUser en envoyant $user en paramètre
    $utilisateur_management->loginUser($user);
}


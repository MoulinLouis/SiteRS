<?php
// On démarre les sessions
session_start();
// On fait appel aux classes
require_once('../../app/utilisateur.php');
require_once('../../app/utilisateur_management.php');

// Si un des champs est vide on affiche un erreur
if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['mdp1']) || empty($_POST['mdp2'])) {
    getError("Veuillez remplir tous les champs", "../../index.php");
} else {
    // Si les mdp ne sont pas identiques on affiche un erreur
    if($_POST['mdp1'] != $_POST['mdp2']) {
        getError("Mot de passe non identique", "../../inscription.php");
    } else {
        // On stock les valeurs envoyées en POST
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp1'];
        // On stock dans l'objet utilisateur les infos de l'utilisateur
        $user = new utilisateur([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mdp' => $mdp
        ]);
        // On stock la classe utilisateur_management dans $utilisateur_management
        $utilisateur_management = new utilisateur_management();
        // On effectue la fonction addUser en envoyant $user en paramètre
        $utilisateur_management->addUser($user);
    }
}



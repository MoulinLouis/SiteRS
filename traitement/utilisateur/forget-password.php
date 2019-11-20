<?php
// On démarre les sessions
session_start();
// On fait appel aux classes
require_once('../../app/utilisateur.php');
require_once('../../app/utilisateur_management.php');
require '../../app/phpmailer/class.phpmailer.php';
require '../../app/phpmailer/class.smtp.php';

if(isset($_POST['mdp_forget'])) {
    // Si un des champs est vide on affiche un erreur
    if(empty($_POST['email'])) {
        getError("Veuillez remplir tous les champs", "../../index.php");
    } else {
        // On stock les valeurs envoyées en POST
        $email = $_POST['email'];
        // On stock dans l'objet utilisateur les infos de l'utilisateur
        $user = new utilisateur([
            'email' => $email,
        ]);
        // On stock la classe utilisateur_management dans $utilisateur_management
        $utilisateur_management = new utilisateur_management();
        // On effectue la fonction loginUser en envoyant $user en paramètre
        $utilisateur_management->forgetPassword($user);
    }
} elseif(isset($_POST['modif_mdp'])) {
    // Si un des champs est vide on affiche un erreur
    if(empty($_POST['decryptKey']) || empty($_POST['mdp'])) {
            getError("Veuillez remplir tous les champs", "../../index.php");
        } else {
        // On stock les valeurs envoyées en POST
        $decryptKey = $_POST['decryptKey'];
        $mdp = $_POST['mdp'];
        // On stock dans l'objet utilisateur les infos de l'utilisateur
        $user = new utilisateur([
            'mdp' => $mdp,
            'decryptKey' => $decryptKey
        ]);
        // On stock la classe utilisateur_management dans $utilisateur_management
        $utilisateur_management = new utilisateur_management();
        // On effectue la fonction editPasswordByDecryptKey en envoyant $user en paramètre
        $utilisateur_management->editPasswordByDecryptKey($user);
    }
}

<?php
// On démarre les sessions
session_start();
// On fait appel aux classes
require_once('../../app/utilisateur.php');
require_once('../../app/utilisateur_management.php');
require '../../app/phpmailer/class.phpmailer.php';
require '../../app/phpmailer/class.smtp.php';

// Si un des champs est vide on affiche un erreur
if(empty($_POST['nom']) || empty($_POST['mail']) || empty($_POST['objet']) || empty($_POST['texte'])) {
    getError("Veuillez remplir tous les champs", "../../contact.php");
} else {
    // On stock les valeurs envoyées en POST
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $objet = $_POST['objet'];
    $texte = $_POST['texte'];

    // On stock dans un tableau les infos du mail
    $contact = [
        'nom' => $nom,
        'mail' => $mail,
        'objet' => $objet,
        'texte' => $texte,

    ];
    // On stock la classe utilisateur_management dans $utilisateur_management
    $utilisateur_management = new utilisateur_management();
    // On effectue la fonction ContactMail en envoyant $contact en paramètre
    $utilisateur_management->ContactMail($contact);

}

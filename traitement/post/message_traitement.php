<?php
session_start();

require_once('../../app/utilisateur_management.php');
require_once('../../app/message.php');
require_once('../../app/message_management.php');

if(empty($_POST['titre']) || empty($_POST['texte'])) {
    getError("Veuillez remplir tous les champs", "../../index.php");
} else {
    $utilisateur_management = new utilisateur_management();

    $utilisateur = $_COOKIE['user'];
    $titre = $_POST['titre'];
    $texte = $_POST['texte'];

    $message = new message([
        'titre' => $titre,
        'texte' => $texte,
        'utilisateur' => $utilisateur,

    ]);
    $new_message = new message_management();
    $new_message->addMessage($message);
    getSuccess("Message envoyé avec succès", "../../chat.php");
}

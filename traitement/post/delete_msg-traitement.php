<?php
// On démarre les sessions
session_start();
// On fait appel aux classes
require_once('../../app/message.php');
require_once('../../app/message_management.php');
include('../../app/functions.php');

// Si un des champs est vide on affiche un erreur
if(empty($_POST['id_message'])) {
    getError("Erreur de redirection", "../../index.php");
} else {
    // On stock la valeur du cookie user
    $id_message = $_POST['id_message'];

    $message = new message([
        'Idmessage' => $id_message,
    ]);
    $message_management = new message_management();
    $message_management->deleteMessage($message);
}
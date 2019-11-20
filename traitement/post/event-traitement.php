<?php
// On démarre les sessions
session_start();
// On fait appel aux classes
require_once('../../app/postevent.php');
require_once('../../app/postevent_management.php');
include('../../app/functions.php');
// Si un des champs est vide on affiche un erreur
if(empty($_POST['titre']) || empty($_POST['texte'])) {
    getError("Veuillez remplir tous les champs", "../../admin.php");
} else {
    // On stock la valeur du cookie user
    $utilisateur = $_COOKIE['user'];
    // On stock les valeurs envoyées en POST
    $titre = $_POST['titre'];
    $texte = $_POST['texte'];

    $post = new postevent([
        'utilisateur' => $utilisateur,
        'titre' => $titre,
        'texte' => $texte,
    ]);

    $new_event = new postevent_management();
    $new_event->addEvent($post);
    getSuccess("évènement posté avec effectué avec succès", "../../admin.php");
}

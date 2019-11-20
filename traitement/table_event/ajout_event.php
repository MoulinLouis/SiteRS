<?php
// On fait appel au classe
include("../../app/postevent.php");
include("../../app/postevent_management.php");
/* OLD VERSION
// On stock les valeurs envoyées en POST
$titre = $_POST['titre'];
$texte = $_POST['texte'];
// On stock dans $post l'objet postevent en indiquant le titre et le texte
$post = new postevent([
    'titre' => $titre,
    'texte' => $texte
]);
// On stock la classe postevent_management dans $postevent_management
$postevent_management = new postevent_management();
// On effectue la fonction addEvent en envoyant l'objet $post en paramètre
$postevent_management->addEvent($post);
*/
$titre = $_POST['reponse'][0];
$texte = $_POST['reponse'][1];

$post = new postevent([
    'titre' => $titre,
    'texte' => $texte
]);
$postevent_management = new postevent_management();
$postevent_management->addEvent($post);

?>
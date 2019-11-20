<?php
// On fait appel au classe
include("../../app/utilisateur.php");
include("../../app/utilisateur_management.php");
/* OLD VERSION
// On stock les valeurs envoyées en POST
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];
// On stock dans $utilisateur l'objet utilisateur en indiquant le titre et le texte
$utilisateur = new utilisateur([
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email,
    'mdp' => $mdp
]);
// On stock la classe utilisateur_management dans $utilisateur_management
$utilisateur_management = new utilisateur_management();
// On effectue la fonction addUser en envoyant l'objet $utilisateur et le type d'ajout en paramètre
$utilisateur_management->addUser($utilisateur, "admin");
*/
$nom = $_POST['reponse'][0];
$prenom = $_POST['reponse'][1];
$email = $_POST['reponse'][2];
$mdp = $_POST['reponse'][3];

$utilisateur = new utilisateur([
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email,
    'mdp' => $mdp
]);
$utilisateur_management = new utilisateur_management();
$utilisateur_management->addUser($utilisateur, "admin");

 ?>


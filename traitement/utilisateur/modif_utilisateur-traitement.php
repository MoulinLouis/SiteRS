<?php
// On démarre les sessions
session_start();
// On fait appel aux classes
require_once('../../app/utilisateur.php');
require_once('../../app/utilisateur_management.php');

if(isset($_POST['form_info'])) {
    // Si un des champs est vide on affiche un erreur
    if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email'])) {
        getError("Veuillez remplir tous les champs", "../../index.php");
    } elseif(!empty($_POST['nom']) || !empty($_POST['prenom']) || !empty($_POST['email'])) {
        // On stock les valeurs envoyées en POST
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        // On stock dans l'objet utilisateur les infos de l'utilisateur
        $user = new utilisateur([
            'iduser' => $_COOKIE['user'],
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
        ]);
        // On stock la classe utilisateur_management dans $utilisateur_management
        $edit = new utilisateur_management();
        // On effectue la fonction addUser en envoyant $user, et le type en paramètre
        $edit->editUser($user, 'info','','');
    }
}

if(isset($_POST['form_mdp'])) {
    if(empty($_POST['old_mdp']) || empty($_POST['mdp1']) || empty($_POST['mdp2'])) {
        getError("Veuillez remplir tous les champs", "../../index.php");
    } elseif(!empty($_POST['old_mdp']) || !empty($_POST['mdp1']) || !empty($_POST['mdp2'])) {

        $old_mdp = $_POST['old_mdp'];
        $mdp1 = $_POST['mdp1'];
        $mdp2 = $_POST['mdp2'];
        $result = new utilisateur_management();
        $real_old_mdp = $result->getMdpById($_COOKIE['user']);
        if($old_mdp == $real_old_mdp['mdp']) {
            if($mdp1 == $mdp2) {
                $user = new utilisateur([
                    'iduser' => $_COOKIE['user'],
                    'mdp' => $mdp1
                ]);
                $edit = new utilisateur_management();
                $edit->editUser($user, 'mdp','','');
            }
        }
    }
}

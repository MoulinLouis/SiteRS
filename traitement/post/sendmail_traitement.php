<?php
session_start();
require_once('../../app/utilisateur.php');
require_once('../../app/utilisateur_management.php');
require '../../app/phpmailer/class.phpmailer.php';
require '../../app/phpmailer/class.smtp.php';

if(empty($_POST['mail']) || empty($_POST['objet']) || empty($_POST['texte'])) {
    getError("Veuillez remplir tous les champs", "../../admin.php");
} else {
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $objet = $_POST['objet'];
    $texte = $_POST['texte'];
    $sendmail = [
        'mail' => $mail,
        'objet' => $objet,
        'texte' => $texte,
    ];

    $mail = new utilisateur_management();
    $mail->SendMail($sendmail);




}
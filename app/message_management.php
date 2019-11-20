<?php

require_once('connexionpdo.php');

class message_management
{

    public function __construct()
    {

    }

    /**
     * @param message $donnees
     */
    // On insère un message dans la base de données
    public function addMessage(message $donnees) {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("INSERT INTO message (utilisateur, classe,titre, texte, date) VALUES ((SELECT id_utilisateur FROM utilisateur WHERE id_utilisateur=?), (SELECT classe FROM utilisateur WHERE id_utilisateur=?), ?, ?,NOW())");
        $prepare->execute([
            $donnees->getUtilisateur(),
            $donnees->getUtilisateur(),
            $donnees->getTitre(),
            $donnees->getTexte(),
        ]);
        getSuccess("Message inséré avec succès", "../../message.php");
    }

    public function deleteMessage(message $donnees) {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("DELETE FROM message WHERE id_message = ?");
        $prepare->execute([
            $donnees->getIdmessage()
        ]);
        echo $donnees->getIdmessage();
        print_r($prepare);
        getSuccess("Message supprimé avec succès", "../../chat.php");

    }

    public function getMessage() {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("
SELECT utilisateur.nom, classe.nom_classe, texte, titre, utilisateur.prenom, date, message.utilisateur, message.id_message
FROM message JOIN utilisateur ON utilisateur.id_utilisateur=message.utilisateur 
JOIN classe ON classe.id_classe = message.classe");
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}
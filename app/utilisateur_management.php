<?php
require_once('connexionpdo.php');
require_once('functions.php');
class utilisateur_management
{

    public function __construct()
    {

    }

    /**
     * @param utilisateur $donnees
     * @param string $type
     */
    // Insertion d'un utilisateur
    public function addUser(utilisateur $donnees, $type="user")
    {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("INSERT INTO utilisateur (nom, prenom, email, mdp, classe, decryptKey) VALUES (?,?,?,?,'14',?)");
        $prepare->execute([
            $donnees->getNom(),
            $donnees->getPrenom(),
            $donnees->getEmail(),
            $donnees->getMdp(),
            genererChaineAleatoire()
        ]);
        if($type=="user") { // Si la modification vient de la modification profil d'un utilisateur
            getSuccess("Inscription effectué avec succès", "../../index.php");
        } elseif(($type=="admin")) { // Si la modification vient du panel admin
            echo 'L\'utilisateur a été ajouté avec succès';
        }
    }
    /**
     * @param utilisateur $donnees
     */
    // Suppression d'un utilisateur par le panel admin
    public function deleteUser(utilisateur $donnees) {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("DELETE FROM utilisateur WHERE id_utilisateur = ?");
        $prepare->execute([
            $donnees->getIduser()
        ]);
        echo 'Utilisateur supprimée avec succès';
    }
    /**
     * @param utilisateur $donnees
     */
    // Connexion d'un utilisateur
    public function loginUser(utilisateur $donnees)
    {
        // TODO mdp à faire avec bcrypt
        $pdo = new connexionpdo();

        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM utilisateur WHERE email = ? AND mdp = ?");
        $prepare->execute([
            $donnees->getEmail(),
            $donnees->getMdp()
        ]);
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        // Si il y a une occurence dans la table utilisateur et la combinaison email/mdp entré
        if ($result) {
            // On met à jour l'activité de l'utilisateur avec la date du jour
            $prepare = $pdo->pdo_start()->prepare("UPDATE utilisateur SET activite = '" . date("Y-m-d") . "' WHERE id_utilisateur = " . $result['id_utilisateur']);
            $prepare->execute();
            // On insère dans users_online l'id de l'utilisateur en vérifiant qu'elle n'existe pas déjà
            $prepare = $pdo->pdo_start()->prepare("INSERT INTO users_online (id_utilisateur)
                                                             SELECT ".$result['id_utilisateur']."
                                                             WHERE NOT EXISTS
                                                             (SELECT id_utilisateur
                                                             FROM users_online
                                                             WHERE id_utilisateur = ".$result['id_utilisateur'].")
            ");
            $prepare->execute();
            // On créé un cookie user avec l'id de l'utilisateur
            // On créé un cookie role avec le role de l'utilisateur
            setcookie('user', $result['id_utilisateur'], time() + 86400 * 10, '/');
            setcookie('role', $result['role'], time() + 86400 * 10, '/');
            getSuccess("Connexion effectuée avec succès", "../../index.php");
        } else {
            getError("Email ou mot de passe incorrect", "../../connexion.php");
        }
    }
    /**
     * @param utilisateur $donnees
     */
    // Attribuer la classe d'un utilisateur par la panel admin
    public function attributeClasseUser(utilisateur $donnees) {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("UPDATE utilisateur SET classe = ? WHERE id_utilisateur = ?");
        $prepare->execute([
            $donnees->getClasse(),
            $donnees->getIduser()
        ]);
        echo 'La classe a bien été attribué';
    }

    // Déconnexion d'un utilisateur
    public function disconnectUser()
    {
        $pdo = new connexionpdo();
        // On supprime d'users_online l'id de la personne se déconnectant
        $prepare = $pdo->pdo_start()->prepare("DELETE FROM users_online WHERE id_utilisateur = ?");
        $prepare->execute([
            $_COOKIE['user']
        ]);
        // On supprime les 2 cookies
        setcookie('user', '', time() - 1, '/');
        setcookie('role', '', time() - 1, '/');
        getSuccess("Déconnexion effectué avec succès", "../../index.php");
    }
    /**
     * @param utilisateur $donnees
     * @param $type
     * @param $texte
     * @param $colonne
     */
    // Modification d'un utilisateur en recevant le type de modification, le texte qu'on voudra modifier et la colonne de celle-ci
    public function editUser(utilisateur $donnees, $type, $texte, $colonne)
    {
        $pdo = new connexionpdo();
        // Modification d'informations par l'espace membre
        if ($type == 'info') {
            $prepare = $pdo->pdo_start()->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, email = ? WHERE id_utilisateur = ?");
            $prepare->execute([
                $donnees->getNom(),
                $donnees->getPrenom(),
                $donnees->getEmail(),
                $donnees->getIduser()
            ]);
            getSuccess("Modification des informations effectué avec succès", "../../index.php");
        } elseif ($type == 'mdp') { // Modification de mdp par l'espace membre
            $prepare = $pdo->pdo_start()->prepare("UPDATE utilisateur SET mdp = ? WHERE id_utilisateur = ?");
            $prepare->execute([
                $donnees->getMdp(),
                $donnees->getIduser()
            ]);
            getSuccess("Modification du mot de passe effectué avec succès", "../../index.php");
        } elseif($type == 'admin') { // Modification d'utilisateur par le panel admin
            $prepare = $pdo->pdo_start()->prepare("UPDATE utilisateur SET ".$colonne."=? WHERE id_utilisateur=?");
            $prepare->execute([
                $texte,
                $donnees->getIduser()
            ]);
            echo 'Données de l\'utilisateur n° '.$donnees->getIduser().' mis à jour effectuée avec succès';
        }
    }

    /**
     * @param $id_user
     * @return mixed
     */
    // On retourne le mot de passe à partir de l'id d'un utilisateur
    public function getMdpById($id_user)
    {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT mdp FROM utilisateur WHERE id_utilisateur = ?");
        $prepare->execute([
            $id_user
        ]);
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param $id_user
     * @return mixed
     */
    // On retourne tous les utilisateurs
    public function getUtilisateur($id_user)
    {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
        $prepare->execute([
            $id_user
        ]);
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @return array
     */
    // On retourne toutes les classes
    public function getClasses()
    {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM classe");
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * @return array
     */
    // On retourne toutes les rôles
    public function getRoles()
    {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM role");
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * @return array
     */
    // On retourne les utilisateurs en faisant des jointures sur les tables classes et role
    public function getUtilisateurs()
    {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("
SELECT utilisateur.nom AS nom,
utilisateur.prenom AS prenom,
utilisateur.email AS email,
utilisateur.activite AS activite,
classe.nom_classe AS classe,
CASE role.nom_role
    WHEN 'adm' THEN 'Administrateur' 
    WHEN 'etu' THEN 'Etudiant' 
    ELSE '' 
END AS role
FROM utilisateur 
JOIN classe ON classe.id_classe = utilisateur.classe 
JOIN role ON role.id_role = utilisateur.role 
");
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @return mixed
     */
    // On retourne le nombre de ligne dans la table utilisateur
    public function countAllUser()
    {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT COUNT(*) FROM utilisateur");
        $prepare->execute();
        $result = $prepare->fetch();
        return $result;
    }
    /**
     * @return mixed
     */
    // On retourne le nombre de ligne dans la table users_online
    public function countUserOnline() {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT COUNT(*) FROM users_online");
        $prepare->execute();
        $result = $prepare->fetch();
        return $result;
    }
    /**
     * @return array
     */
    // On retourne un tableau avec les adresses emails des utilisateurs en ligne
    public function listUserOnline() {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT utilisateur.email FROM users_online INNER JOIN utilisateur ON users_online.id_utilisateur = utilisateur.id_utilisateur");
        $prepare->execute();
        $result = $prepare->fetchAll();
        return $result;
    }
    /**
     * @param utilisateur $donnees
     */
    // Fonction permettant d'envoyer un email avec la clé de décryptage pour modifier son mot de passe oublié
    public function forgetPassword(utilisateur $donnees)
    {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT prenom, decryptKey FROM utilisateur WHERE email = ?");
        $prepare->execute([
            $donnees->getEmail()
        ]);
        $result = $prepare->fetch(PDO::FETCH_ASSOC);

        $to = $donnees->getEmail();
        $from = "siters93440@gmail.com";
        $from_nom = "SiteRS";
        $objet = "Modification de mot de passe";
        $texte = "Bonjour " . $result['prenom'] . ".<br><br>
        Vous nous avez parvenu une demande de réintialisation de mot de passe.<br>
        Votre clé de décryptage est la suivante : <strong>" . $result['decryptKey'] . "</strong><br>
        Afin de réintialiser votre mot de passe, veuillez renseigner cette clé dans le champs indiqué sur notre site.<br><br>
        Si vous n'avez pas demandé ce code en configurant la vérification de connexion, accédez à votre page 
        <strong>Espace membre</strong> et modifiez votre mot de passe immédiatement.<br>
        Pour toute demande d'assistance, contactez nous via notre page <strong>Contact</strong>.<br><br>
        Merci de nous aider à rendre votre compte plus sûr.<br><br>
        Amusez-vous bien!<br>
        L'équipe SiteRS";

        $result = smtpmailer($to, $from, $from_nom, $objet, $texte);
        if ($result == true) {
            getSuccess("Envoie du mail effectué avec succès", "../../reintialisation.php");
        } else {
            getError("Erreur dans l'envoie du mail", "../../index.php");
        }
    }
    /**
     * @param utilisateur $donnees
     */
    // Fonction permettant de modifier son mot de passe en envoyant sa clé de décryptage
    public function editPasswordByDecryptKey(utilisateur $donnees) {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("UPDATE utilisateur SET mdp=? WHERE decryptKey = ?");
        $prepare->execute([
            $donnees->getMdp(),
            $donnees->getDecryptKey()
        ]);
        getSuccess("Modification de mot de passe effectué avec succès", "../../index.php");
    }

    /**
     * @param array $donnees
     */
    // Envoie de mail
    public function SendMail(array $donnees)
    {
        $to = $donnees["mail"];
        $from = "siters93440@gmail.com";
        $from_nom = "SiteRS";
        $objet = $donnees["objet"];
        $texte = $donnees["texte"];

        $result = smtpmailer($to, $from, $from_nom, $objet, $texte);
        if ($result == true) {
            getSuccess("Envoie du mail effectué avec succès", "../../admin.php");
        } else {
            getError("Erreur dans l'envoie du mail", "../../admin.php");
        }
    }
    /**
     * @return array
     */
    // On récupère tous les emails de la table utilisateur
    public function getMails() {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT email FROM utilisateur");
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function ContactMail(array $donnees) {
        $to = "siters93440@gmail.com";
        $from = "siters93440@gmail.com";
        $from_nom = $donnees ['mail'];
        $objet = $donnees["objet"];
        $texte = "De : ".$donnees["nom"]."<br>".$donnees["texte"];

        $result = smtpmailer($to, $from, $from_nom, $objet, $texte);
        if ($result == true) {
            getSuccess("Envoie du mail effectué avec succès", "../../index.php");
        } else {
            getError("Erreur dans l'envoie du mail", "../../index.php");
        }
    }

    // Fonction permettant de retourner le code html du tableau des évènements
    public function getUserInHtml() {
        $output = '';
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT utilisateur.id_utilisateur,
                                                         utilisateur.nom,
                                                         utilisateur.prenom,
                                                         utilisateur.email,
                                                         utilisateur.mdp,
                                                         classe.nom_classe,
                                                         utilisateur.classe,
                                                         utilisateur.activite
                                                         FROM utilisateur 
                                                         INNER JOIN classe ON utilisateur.classe = classe.id_classe
                                                         WHERE utilisateur.role != 2");
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        $output .= '  
            <div class="table-responsive">  
                 <table class="table table-bordered">  
                      <tr>  
                           <th width="1%">Id</th>  
                           <th width="15%">Nom</th>  
                           <th width="15%">Prénom</th>
                           <th width="15%">Email</th>
                           <th width="15%">Mdp</th>
                           <th width="15%">Classe</th>
                           <th width="10%">Dernière connexion</th>  
                           <th width="1%">Statut</th>
                           <th width="5%">Attribuer classe</th>  
                           <th width="5%">Supprimer</th>
                      </tr>';
        if($result) {
            foreach ($result as $row) {
                $start_date = strtotime($row["activite"]);
                $end_date = strtotime(date("Y-m-d"));
                $date_diff = ($end_date - $start_date)/60/60/24;
                if($row["activite"] == null) {
                    $icon = "times";
                    $color = 'red';
                    $message = "L'utilisateur ne s'est pas encore connecté";
                    $row["activite"] = "Non défini";
                } elseif($date_diff > 6) {
                    $icon = "exclamation";
                    $color = 'orange';
                    $message = "L'utilisateur s'est connecté il y a une semaine ou plus";
                } elseif($date_diff <= 6) {
                    $icon = "check";
                    $color = 'green';
                    $message = "L'utilisateur s'est connecté il y a moins d'une semaine";
                }
                $output .= '  
                    <tr>  
                         <td>' . $row["id_utilisateur"] . '</td>  
                         <td class="nom_user" data-id4="' . $row["id_utilisateur"] . '" contenteditable>' . $row["nom"] . '</td>  
                         <td class="prenom_user" data-id5="' . $row["id_utilisateur"] . '" contenteditable>' . $row["prenom"] . '</td>
                         <td class="email_user" data-id6="' . $row["id_utilisateur"] . '" contenteditable>' . $row["email"] . '</td>
                         <td class="mdp_user">************************</td>
                         <td class="classe_user" >' . $row["nom_classe"] . '</td>
                         <td class="activite_user">' . $row["activite"] . '</td>
                         <td class="statut_user">
                         <span>
                         <a data-tooltip="'.$message.'"><i class="fa fa-'.$icon.'-circle fa-2x" style="color: '.$color.'; text-align: center; width: 100%"></i></a>
                         </span>
                         </td>  
                         <td class="text-center">
                                <button type="submit" data-id7="' . $row["id_utilisateur"] . '" data-id9="' . $row["classe"] . '" id="btn_classe" name="classe" value="'. $row['classe'] .'" class="btn btn-xs btn-primary"><i class="fa fa-graduation-cap"></i></button>
                         </td>
                         <td class="text-center"><button type="button" name="delete_btn" data-id8="' . $row["id_utilisateur"] . '" class="btn btn-xs btn-danger btn_delete_user"><i class="fa fa-trash"></i></button></td>  
                    </tr>  
           ';
            }
        } else {
            $output .= '
				<tr>  
					<td></td>  
					<td id="nom_user" contenteditable></td>  
					<td id="prenom_user" contenteditable></td>
					<td id="email_user" contenteditable></td>
					<td id="mdp_user" contenteditable></td>
					<td><button type="button" name="btn_add_user" id="btn_add_user" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></button></td>  
			   </tr>';
        }
        $output .= '</table>  
      </div>';
        echo $output;
    }

}
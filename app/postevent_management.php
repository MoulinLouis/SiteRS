<?php

require_once('connexionpdo.php');

class postevent_management
{

    public function __construct()
    {

    }

    // Insertion d'un évènement
    public function addEvent(postevent $donnees) {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("INSERT INTO post (titre, texte, date) VALUES (?, ?,NOW())");
        $prepare->execute([
            $donnees->getTitre(),
            $donnees->getTexte()
        ]);
        echo 'L\'évènement '.$donnees->getTitre().' a été ajouté avec succès';
    }

    // Modification d'un évènement
    public function editEvent(postevent $donnees, $colonne) {
        $pdo = new connexionpdo();
        // On récupère dans la base ce qu'on veut modifier
        $prepare = $pdo->pdo_start()->prepare("SELECT ".$colonne." FROM post WHERE id = ".$donnees->getIdpost()."");
        $prepare->execute();
        $result = $prepare->fetch();
        // Si la valeur de la base est égal à la valeur entrée on ne modifie pas
        if($result[0] == $donnees->getTexte()) {
            echo 'Aucune données modifiées';
        } else { // Sinon on modifie
            // On met à jour la colonne qu'on veut avec la valeur entrée
            $prepare = $pdo->pdo_start()->prepare("UPDATE post SET ".$colonne."=? WHERE id=?");
            $prepare->execute([
                $donnees->getTexte(),
                $donnees->getIdpost()
            ]);
            echo 'Données de l\'évènement n° '.$donnees->getIdpost().' mis à jour effectuée avec succès';
        }

    }
    // Suppression d'un évènement
    public function deleteEvent(postevent $donnees) {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("DELETE FROM post WHERE id = ?");
        $prepare->execute([
            $donnees->getIdpost()
        ]);
        echo 'Données de l\'évènement '.$donnees->getIdpost().' supprimées avec succès';
    }

    // On retourne un tableau avec toutes les valeurs de la table post
    public function getEvents() {
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM post");
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // Fonction permettant de retourner le code html du tableau des évènements
    public function getEventInHtml() {
        $output = '';
        $pdo = new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM post");
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        $output .= '  
            <div class="table-responsive">  
                 <table class="table table-bordered">  
                      <tr>  
                           <th width="10%">Id</th>  
                           <th width="40%">Titre</th>  
                           <th width="40%">Texte</th>  
                           <th width="10%">Supprimer</th>   
                      </tr>';
        if($result) {
            foreach ($result as $row) {
                $output .= '  
                    <tr>  
                         <td>' . $row["id"] . '</td>  
                         <td class="titre_event" data-id1="' . $row["id"] . '" contenteditable>' . $row["titre"] . '</td>  
                         <td class="texte_event" data-id2="' . $row["id"] . '" contenteditable>' . $row["texte"] . '</td>  
                         <td><button type="button" name="delete_btn" data-id3="' . $row["id"] . '" class="btn btn-xs btn-danger btn_delete_event"><i class="fa fa-trash"></i></button></td>
                           
                    </tr>  
           ';
            }
        } else {
            $output .= '
				<tr>  
					<td></td>  
					<td id="titre_event" contenteditable></td>  
					<td id="texte_event" contenteditable></td>
					  
					<td><button type="button" name="btn_add_event" id="btn_add_event" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></button></td>  
			   </tr>';
        }
        $output .= '</table>  
      </div>';
        echo $output;
    }




}
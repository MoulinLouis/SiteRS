<?php
require_once('connexionpdo.php');
class utilisateur {
    public $_iduser, $_nom, $_prenom, $_email, $_mdp, $_classe, $_role, $_activite, $_decryptKey;

    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getIduser() { return $this->_iduser; }
    public function getNom() { return $this->_nom; }
    public function getPrenom() { return $this->_prenom; }
    public function getEmail() { return $this->_email; }
    public function getMdp() { return $this->_mdp; }
    public function getClasse() { return $this->_classe; }
    public function getRole() { return $this->_role; }
    public function getActivite() { return $this->_activite; }
    public function getDecryptKey() { return $this->_decryptKey; }

    public function setIduser($iduser) {
        if ($iduser >= 0 && $iduser <= 100) {
            $this->_iduser = $iduser;
        }
    }
    public function setNom($nom) {
        if (is_string($nom) && strlen($nom) <= 255) {
            $this->_nom = $nom;
        }
    }
    public function setPrenom($prenom) {
        if (is_string($prenom) && strlen($prenom) <= 255) {
            $this->_prenom = $prenom;
        }
    }
    public function setEmail($email) {
        if (is_string($email) && strlen($email) <= 255) {
            $this->_email = $email;
        }
    }
    public function setMdp($mdp) {
        if (is_string($mdp) && strlen($mdp) <= 255) {
            $this->_mdp = $mdp;
        }
    }
    public function setClasse($classe) {
        if ($classe >= 0 && $classe <= 100) {
            $this->_classe = $classe;
        }
    }
    public function setRole($role) {
        if ($role >= 0 && $role <= 100) {
            $this->_role = $role;
        }
    }
    public function setActivite($activite) {
        if (is_string($activite) && strlen($activite) <= 255) {
            $this->_activite = $activite;
        }
    }
    public function setDecryptKey($decryptKey) {
        if (is_string($decryptKey) && strlen($decryptKey) <= 255) {
            $this->_decryptKey = $decryptKey;
        }
    }
}
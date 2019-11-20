<?php

class message
{
    public $_idmessage, $_titre, $_texte, $_date, $_classe, $_utilisateur;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getIdmessage()
    {
        return $this->_idmessage;
    }

    public function getUtilisateur()
    {
        return $this->_utilisateur;
    }

    public function getTitre()
    {
        return $this->_titre;
    }

    public function getTexte()
    {
        return $this->_texte;
    }

    public function getDate()
    {
        return $this->_date;
    }
    public function getClasse()
    {
        return $this->_classe;
    }

    public function setIdmessage($idmessage)
    {
        if ($idmessage >= 0 && $idmessage <= 100) {
            $this->_idmessage = $idmessage;
        }
    }

    public function setutilisateur($utilisateur)
    {
        if (is_string($utilisateur) && strlen($utilisateur) <= 255) {
            $this->_utilisateur = $utilisateur;
        }
    }

    public function setTitre($titre)
    {
        if (is_string($titre) && strlen($titre) <= 255) {
            $this->_titre = $titre;
        }
    }

    public function setTexte($texte)
    {
        if (is_string($texte) && strlen($texte) <= 255) {
            $this->_texte = $texte;
        }
    }

    public function setDate($date)
    {
        if (is_string($date) && strlen($date) <= 255) {
            $this->_date = $date;
        }
    }

    public function setClasse($classe)
    {
        if (is_string($classe) && strlen($classe) <= 255) {
            $this->_classe = $classe;
        }
    }

}
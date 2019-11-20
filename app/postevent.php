<?php


class postevent{
    public $_idpost, $_utilisateur, $_titre, $_texte, $_date;

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

    public function getIdpost()
    {
        return $this->_idpost;
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

    public function setIdpost($idpost)
    {
        if ($idpost >= 0 && $idpost <= 100) {
            $this->_idpost = $idpost;
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

}
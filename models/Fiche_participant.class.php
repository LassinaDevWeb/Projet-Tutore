<?php
class Fiche_participant
{
    private $id_participant;
    private $nom;
    private $prenom;
    private $date_naissance;
    private $adresse;
    private $ville;
    private $email;
    private $diplome;
    private $telephone;


    public static $fiche_participant;

    public function __construct($id_participant, $nom, $prenom, $date_naissance, $adresse, $ville, $email, $diplome, $telephone)
    {
        $this->id_participant = $id_participant;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->email = $email;
        $this->diplome = $diplome;
        $this->telephone = $telephone;
        self::$fiche_participant[] = $this;
    }

    public function getId()
    {
        return $this->id_participant;
    }
    public function setId($id_participant)
    {
        return $this->id_participant = $id_participant;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        return $this->nom = $nom;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        return $this->prenom = $prenom;
    }


    public function getDate_naissance()
    {
        return $this->date_naissance;
    }
    public function setDate_naissance($date_naissance)
    {
        return $this->date_naissance = $date_naissance;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }
    public function setAdresse($adresse)
    {
        return $this->adresse = $adresse;
    }


    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        return $this->email = $email;
    }

    public function getVille()
    {
        return $this->ville;
    }
    public function setVille($ville)
    {
        return $this->ville = $ville;
    }


    public function getDiplome()
    {
        return $this->diplome;
    }
    public function setDiplome($diplome)
    {
        return $this->diplome = $diplome;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }
    public function setTelephone($telephone)
    {
        return $this->telephone = $telephone;
    }
}

<?php
class Participer
{
    private $id_program;
    private $id_participation;
    private $nom;
    private $prenom;
    private $date_naissance;
    private $adresse;
    private $ville;
    private $email;
    private $diplome;
    private $telephone;


    public static $participer;

    public function __construct($id_program, $id_participation, $nom, $prenom, $date_naissance, $adresse, $ville, $email, $diplome, $telephone)
    {
        $this->id_program = $id_program;
        $this->id_participation = $id_participation;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->email = $email;
        $this->diplome = $diplome;
        $this->telephone = $telephone;

        self::$participer[] = $this;
    }

    public function getId_program()
    {
        return $this->id_program;
    }
    public function setId_program($id_program)
    {
        return $this->id_program = $id_program;
    }

    public function getId_participation()
    {
        return $this->id_participation;
    }
    public function setId_participation($id_participation)
    {
        return $this->id_participation = $id_participation;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }


    public function getDate_naissance()
    {
        return $this->date_naissance;
    }


    public function getAdresse()
    {
        return $this->adresse;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function getVille()
    {
        return $this->ville;
    }


    public function getDiplome()
    {
        return $this->diplome;
    }


    public function getTelephone()
    {
        return $this->telephone;
    }
}

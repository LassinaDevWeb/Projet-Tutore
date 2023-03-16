<?php
class Etablissement
{
    private $id_etablissement;
    private $nom;
    private $ville;
    private $centre;
    private $hebergement;
    private $restauration;


    public static $etablissements;

    public function __construct($id_etablissement, $nom, $ville, $centre, $hebergement, $restauration)
    {
        $this->id_etablissement = $id_etablissement;
        $this->nom = $nom;
        $this->ville = $ville;
        $this->centre = $centre;
        $this->hebergement = $hebergement;
        $this->restauration = $restauration;
        self::$etablissements[] = $this;
    }

    public function getId()
    {
        return $this->id_etablissement;
    }
    public function setId($id_etablissement)
    {
        return $this->id_etablissement = $id_etablissement;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        return $this->nom = $nom;
    }

    public function getVille()
    {
        return $this->ville;
    }
    public function setVille($ville)
    {
        return $this->ville = $ville;
    }

    public function getCentre()
    {
        return $this->centre;
    }
    public function setCentre($centre)
    {
        return $this->centre = $centre;
    }

    public function getHebergement()
    {
        return $this->hebergement;
    }
    public function setHebergement($hebergement)
    {
        return $this->hebergement = $hebergement;
    }

    public function getRestauration()
    {
        return $this->restauration;
    }
    public function setRestauration($restauration)
    {
        return $this->restauration = $restauration;
    }
}

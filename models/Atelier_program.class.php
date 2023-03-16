<?php
class Atelier_program
{
    private $id;
    private $date_jour_heure;
    private $nombre_mini;
    private $nombre_max;
    private $id_derouler;
    private $id_catalogue;
    private $id_organiser;
    private $contenu;
    private $date_duree;
    private $prerequis;
    private $objectif;
    private $titre;
    private $nom;

    public static $ateliers_program;

    public function __construct($id, $date_jour_heure, $nombre_mini, $nombre_max, $id_derouler, $id_catalogue, $id_organiser, $contenu, $date_duree, $prerequis, $objectif, $titre, $nom)
    {
        $this->id = $id;
        $this->date_jour_heure = $date_jour_heure;
        $this->nombre_mini = $nombre_mini;
        $this->nombre_max = $nombre_max;
        $this->id_derouler = $id_derouler;
        $this->id_catalogue = $id_catalogue;
        $this->id_organiser = $id_organiser;
        $this->contenu = $contenu;
        $this->date_duree = $date_duree;
        $this->prerequis = $prerequis;
        $this->objectif = $objectif;
        $this->titre = $titre;
        $this->nom = $nom;
        self::$ateliers_program[] = $this;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        return $this->id = $id;
    }

    public function getDate_jour_heure()
    {
        return $this->date_jour_heure;
    }
    public function setDate_jour_heure($date_jour_heure)
    {
        return $this->date_jour_heure = $date_jour_heure;
    }

    public function getNombre_mini()
    {
        return $this->nombre_mini;
    }
    public function setNombre_mini($nombre_mini)
    {
        return $this->nombre_mini = $nombre_mini;
    }

    public function getNombre_max()
    {
        return $this->nombre_max;
    }
    public function setNombre_max($nombre_max)
    {
        return $this->nombre_max = $nombre_max;
    }

    public function getId_derouler()
    {
        return $this->id_derouler;
    }
    public function setId_derouler($id_derouler)
    {
        return $this->id_derouler = $id_derouler;
    }

    public function getId_catalogue()
    {
        return $this->id_catalogue;
    }
    public function setId_catalogue($id_catalogue)
    {
        return $this->id_catalogue = $id_catalogue;
    }

    public function getId_organiser()
    {
        return $this->id_organiser;
    }
    public function setId_organiser($id_organiser)
    {
        return $this->id_organiser = $id_organiser;
    }


    public function getContenu()
    {
        return $this->contenu;
    }

    public function getDate_duree()
    {
        return $this->date_duree;
    }


    public function getPrerequis()
    {
        return $this->prerequis;
    }


    public function getObjectif()
    {
        return $this->objectif;
    }


    public function getTitre()
    {
        return $this->titre;
    }

    public function getNom()
    {
        return $this->nom;
    }
}

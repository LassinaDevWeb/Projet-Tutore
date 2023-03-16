<?php
class Atelier_cata
{
    private $id_cata;
    private $contenu;
    private $date_duree;
    private $prerequis;
    private $image;
    private $objectif;
    private $titre;

    public static $ateliers_cata;

    public function __construct($id_cata, $contenu, $date_duree, $prerequis, $image, $objectif, $titre)
    {
        $this->id_cata = $id_cata;
        $this->contenu = $contenu;
        $this->date_duree = $date_duree;
        $this->prerequis = $prerequis;
        $this->image = $image;
        $this->objectif = $objectif;
        $this->titre = $titre;
        self::$ateliers_cata[] = $this;
    }

    public function getId()
    {
        return $this->id_cata;
    }
    public function setId($id_cata)
    {
        return $this->id_cata = $id_cata;
    }

    public function getContenu()
    {
        return $this->contenu;
    }
    public function setContenu($contenu)
    {
        return $this->contenu = $contenu;
    }

    public function getDate_duree()
    {
        return $this->date_duree;
    }
    public function setDate_duree($date_duree)
    {
        return $this->date_duree = $date_duree;
    }

    public function getPrerequis()
    {
        return $this->prerequis;
    }
    public function setPrerequis($prerequis)
    {
        return $this->prerequis = $prerequis;
    }

    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        return $this->image = $image;
    }

    public function getObjectif()
    {
        return $this->objectif;
    }
    public function setObjectif($objectif)
    {
        return $this->objectif = $objectif;
    }

    public function getTitre()
    {
        return $this->titre;
    }
    public function setTitre($titre)
    {
        return $this->titre = $titre;
    }
}

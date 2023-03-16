<?php
require_once "Model.class.php";
require_once "Atelier_cata.class.php";


class Atelier_cataManager extends Model
{

    private $ateliers_cata;

    public function ajoutAtelier_cata($atelier_cata)
    {

        $this->ateliers_cata[] = $atelier_cata;
    }

    public function getAteliers_cata()
    {
        return $this->ateliers_cata;
    }

    public function chargementAtelier_cata()
    {

        $sql = $this->getBdd()->prepare("SELECT id_cata,contenu,date_duree,prerequis,image,objectif,titre FROM  ATELIERS_CATA");
        $sql->execute();
        $mesAteliers_cata = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesAteliers_cata as $atelier_cata) {
            $atelier_cata = new Atelier_cata($atelier_cata['id_cata'], $atelier_cata['contenu'], $atelier_cata['date_duree'], $atelier_cata['prerequis'], $atelier_cata['image'], $atelier_cata['objectif'], $atelier_cata['titre']);
            $this->ajoutAtelier_cata($atelier_cata);
        }
    }

    public function ajoutAtelier_cataBD($contenu, $date_dure, $prerequis, $image, $objectif, $titre)
    {

        $sql = '
        INSERT INTO ATELIERS_CATA (contenu,date_duree,prerequis,image,objectif,titre)
        VALUES (:CONTENU,:DATE_DUREE,:PREREQUIS,:IMAGE,:OBJECTIF,:TITRE)
        ';
        //insert into ATELIERS_CATA(contenu,date_duree,prerequis,image,objectif,titre) values(?,?,?,?,?,?)
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":CONTENU", $contenu, PDO::PARAM_STR);
        $stmt->bindValue(":DATE_DUREE", $date_dure, PDO::PARAM_STR);
        $stmt->bindValue(":PREREQUIS", $prerequis, PDO::PARAM_STR);
        $stmt->bindValue(":IMAGE", $image, PDO::PARAM_STR);
        $stmt->bindValue(":OBJECTIF", $objectif, PDO::PARAM_STR);
        $stmt->bindValue(":TITRE", $titre, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {

            $atelier_cata = new Atelier_cata($this->getBdd()->lastInsertId(), $contenu, $date_dure, $prerequis, $image, $objectif, $titre);
            $this->ajoutAtelier_cata($atelier_cata);
        }
    }

    public function getAtelier_cataByTitre($titre)
    {
        for ($i = 0; $i < count($this->ateliers_cata); $i++) {
            if ($this->ateliers_cata[$i]->getTitre() === $titre) {
                return $this->ateliers_cata[$i];
            }
        }
        throw new Exception("L'atelier programmer n'existe pas");
    }

    public function getIdbyTitre($titre)
    {

        for ($i = 0; $i < count($this->ateliers_cata); $i++) {
            if ($this->ateliers_cata[$i]->getTitre() === $titre) {
                return $this->ateliers_cata[$i]->getId();
            }
        }
    }

    public function getAtelier_cataById($id)
    {
        for ($i = 0; $i < count($this->ateliers_cata); $i++) {
            if ($this->ateliers_cata[$i]->getId() === $id) {
                return $this->ateliers_cata[$i];
            }
        }
        throw new Exception("L'atelier programmer n'existe pas");
    }


    public function suppressionAtelier_cataBD($id_cata)
    {
        $sql = '
        DELETE FROM ATELIERS_CATA WHERE id_cata=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id_cata, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $atelier_cata = $this->getAtelier_cataById($id_cata);
            unset($atelier_cata);
        }
    }
}

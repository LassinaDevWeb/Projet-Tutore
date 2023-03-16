<?php
require_once "Model.class.php";
require_once "Atelier_program.class.php";


class Atelier_programManager extends Model
{

    private $ateliers_program;
    private $ateliers_centre;

    public function ajoutAtelier_program($atelier_program)
    {

        $this->ateliers_program[] = $atelier_program;
    }

    public function getAteliers_program()
    {
        return $this->ateliers_program;
    }



    public function chargementAtelier_program()
    {

        $sql = $this->getBdd()->prepare("SELECT id,date_jour_heure,nombre_mini,nombre_max,id_derouler,id_catalogue,id_organiser,contenu,date_duree,prerequis,objectif,titre,nom FROM  ATELIERS_PROGRAM INNER JOIN ATELIERS_CATA ON ATELIERS_PROGRAM.id_catalogue = ATELIERS_CATA.id_cata INNER JOIN ETABLISSEMENT ON ATELIERS_PROGRAM.id_organiser = ETABLISSEMENT.id_etablissement");
        $sql->execute();
        $mesAteliers_program = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesAteliers_program as $atelier_program) {
            $atelier_program = new atelier_program($atelier_program['id'], $atelier_program['date_jour_heure'], $atelier_program['nombre_mini'], $atelier_program['nombre_max'], $atelier_program['id_derouler'], $atelier_program['id_catalogue'], $atelier_program['id_organiser'], $atelier_program['contenu'], $atelier_program['date_duree'], $atelier_program['prerequis'], $atelier_program['objectif'], $atelier_program['titre'], $atelier_program['nom']);
            $this->ajoutAtelier_program($atelier_program);
        }
    }

    public function ajoutAtelier_programBD($date_jour_heure, $nombre_mini, $nombre_max, $id_derouler, $id_cata, $id_organiser)
    {

        $sql = '
        INSERT INTO ATELIERS_PROGRAM (date_jour_heure,nombre_mini,nombre_max,id_derouler,id_catalogue,id_organiser)
        VALUES (:DATE_JOUR_HEURE,:NOMBRE_MINI,:NOMBRE_MAX,:ID_DEROULER,:ID_CATALOGUE,:ID_ORGANISER)
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":DATE_JOUR_HEURE", $date_jour_heure, PDO::PARAM_STR);
        $stmt->bindValue(":NOMBRE_MINI", $nombre_mini, PDO::PARAM_INT);
        $stmt->bindValue(":NOMBRE_MAX", $nombre_max, PDO::PARAM_INT);
        $stmt->bindValue(":ID_DEROULER", $id_derouler, PDO::PARAM_INT);
        $stmt->bindValue(":ID_CATALOGUE", $id_cata, PDO::PARAM_INT);
        $stmt->bindValue(":ID_ORGANISER", $id_organiser, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }


    public function getAtelier_programByCentre($id_centre)
    {
        for ($i = 0; $i < count($this->ateliers_program); $i++) {
            if ($this->ateliers_program[$i]->getId_organiser() === $id_centre) {
                $ateliers_centre[] = $this->ateliers_program[$i];
            }
        }
        return  $ateliers_centre;
    }



    public function getAtelier_programById($id)
    {
        for ($i = 0; $i < count($this->ateliers_program); $i++) {
            if ($this->ateliers_program[$i]->getId() === $id) {
                return $this->ateliers_program[$i];
            }
        }
        throw new Exception("L'atelier programmer n'existe pas");
    }

    public function getAtelier_programById_cata($id_cata)
    {
        if (!empty($this->ateliers_program)) {
            for ($i = 0; $i < count($this->ateliers_program); $i++) {
                if ($this->ateliers_program[$i]->getId_catalogue() === $id_cata) {
                    return $this->ateliers_program[$i];
                }
            }
        }
    }


    public function suppressionAtelier_programBD($id)
    {
        $sql = '
        DELETE FROM ATELIERS_PROGRAM WHERE id=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $atelier_program = $this->getAtelier_programById($id);
            unset($atelier_program);
        }
    }

    public function suppressionAtelier_programid_cata($id_cata)
    {
        $sql = '
        DELETE FROM ATELIERS_PROGRAM WHERE id_catalogue=:ID_CATALOGUE
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID_CATALOGUE", $id_cata, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $atelier_program = $this->getAtelier_programById_cata($id_cata);
            unset($atelier_program);
        }
    }
}

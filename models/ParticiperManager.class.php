<?php
require_once "Model.class.php";
require_once "Participer.class.php";


class ParticiperManager extends Model
{

    private $participers;

    public function ajoutParticiper($participer)
    {

        $this->participers[] = $participer;
    }

    public function getParticipers()
    {
        return $this->participers;
    }

    public function chargementParticiper()
    {

        $sql = $this->getBdd()->prepare("SELECT id_program,id_participation,nom,prenom,date_naissance,adresse,ville,email,diplome,telephone  FROM PARTICIPER INNER JOIN FICHE_PARTICIPANT ON PARTICIPER.id_participation = FICHE_PARTICIPANT.id_participant");
        $sql->execute();
        $mesParticipers = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesParticipers as $participer) {
            $participer = new Participer($participer['id_program'], $participer['id_participation'], $participer['nom'], $participer['prenom'], $participer['date_naissance'], $participer['adresse'],  $participer['ville'], $participer['email'], $participer['diplome'], $participer['telephone']);
            $this->ajoutParticiper($participer);
        }
    }


    public function getParticiperbyId_program($id)
    {

        for ($i = 0; $i < count($this->participers); $i++) {
            if ($this->participers[$i]->getId_program() === $id) {

                return $this->participers[$i];
            }
        }
    }

    public function getParticiperbyId_participation($id)
    {

        for ($i = 0; $i < count($this->participers); $i++) {
            if ($this->participers[$i]->getId_participation() === $id) {

                return $this->participers[$i];
            }
        }
    }

    public function getParticipantbyId_program($id)
    {
        if (!empty($this->participers)) {


            for ($i = 0; $i < count($this->participers); $i++) {
                if ($this->participers[$i]->getId_program() === $id) {
                    $participant_atelier[] = $this->participers[$i];
                    return $participant_atelier;
                }
            }
        }
    }

    public function suppressionParticiperBD($id)
    {
        $sql = '
        DELETE FROM PARTICIPER WHERE id_program=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $participer = $this->getParticiperbyId_program($id);
            unset($participer);
        }
    }

    public function suppressionParticiperBDbyId_participation($id)
    {
        $sql = '
        DELETE FROM PARTICIPER WHERE id_participation=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $participer = $this->getParticiperbyId_participation($id);
            unset($participer);
        }
    }
    public function ajoutParticiperBD($id_program, $id_participation)
    {

        $sql = '
        INSERT INTO PARTICIPER (id_program,id_participation)
        VALUES (:ID_PROGRAM,:ID_PARTICIPATION)
        ';

        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID_PROGRAM", $id_program, PDO::PARAM_STR);
        $stmt->bindValue(":ID_PARTICIPATION", $id_participation, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }
}

<?php
require_once "Model.class.php";
require_once "Fiche_participant.class.php";


class Fiche_participantManager extends Model
{

    private $fiches_participant;

    public function ajoutFiche_participant($fiche_participant)
    {

        $this->fiches_participant[] = $fiche_participant;
    }

    public function getFiches_participant()
    {
        return $this->fiches_participant;
    }

    public function chargementFiche_participant()
    {

        $sql = $this->getBdd()->prepare("SELECT id_participant,nom,prenom,date_naissance,adresse,ville,email,diplome,telephone FROM  FICHE_PARTICIPANT");
        $sql->execute();
        $mesFiches_participant = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesFiches_participant as $fiche_participant) {
            $fiche_participant = new Fiche_participant($fiche_participant['id_participant'], $fiche_participant['nom'], $fiche_participant['prenom'], $fiche_participant['date_naissance'], $fiche_participant['adresse'], $fiche_participant['ville'], $fiche_participant['email'], $fiche_participant['diplome'], $fiche_participant['telephone']);
            $this->ajoutFiche_participant($fiche_participant);
        }
    }

    public function ajoutFiche_participantBD($nom, $prenom, $date_naissance, $adresse, $ville, $email, $diplome, $telephone)
    {

        $sql = '
        INSERT INTO FICHE_PARTICIPANT (nom,prenom,date_naissance,adresse,ville,email,diplome,telephone)
        VALUES (:NOM,:PRENOM,:DATE_NAISSANCE,:ADRESSE,:VILLE,:EMAIL,:DIPLOME,:TELEPHONE)
        ';

        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":NOM", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":PRENOM", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":DATE_NAISSANCE", $date_naissance, PDO::PARAM_STR);
        $stmt->bindValue(":ADRESSE", $adresse, PDO::PARAM_STR);
        $stmt->bindValue(":VILLE", $ville, PDO::PARAM_STR);
        $stmt->bindValue(":EMAIL", $email, PDO::PARAM_STR);
        $stmt->bindValue(":DIPLOME", $diplome, PDO::PARAM_STR);
        $stmt->bindValue(":TELEPHONE", $telephone, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $fiche_participant = new Fiche_participant($this->getBdd()->lastInsertId(), $nom, $prenom, $date_naissance, $adresse, $ville, $email, $diplome, $telephone);
            $this->ajoutFiche_participant($fiche_participant);
        }
    }

    public function getIdbyEmail($email)
    {

        for ($i = 0; $i < count($this->fiches_participant); $i++) {
            if ($this->fiches_participant[$i]->getEmail() === $email) {

                return $this->fiches_participant[$i]->getId();
            }
        }
        throw new Exception("La fiche n'existe pas");
    }
    public function suppressionfiche_participant($id)
    {
        $sql = '
        DELETE FROM FICHE_PARTICIPANT WHERE id_participant=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }
}

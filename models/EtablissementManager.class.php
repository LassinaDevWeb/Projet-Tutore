<?php
require_once "Model.class.php";
require_once "Etablissement.class.php";


class EtablissementManager extends Model
{

    private $etablissements;

    public function ajoutEtablissement($etablissement)
    {

        $this->etablissements[] = $etablissement;
    }

    public function getEtablissement()
    {
        return $this->etablissements;
    }

    public function chargementEtablissement()
    {

        $sql = $this->getBdd()->prepare("SELECT id_etablissement,nom,ville,centre,hebergement,restauration FROM  ETABLISSEMENT");
        $sql->execute();
        $mesEtablissement = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesEtablissement as $etablissement) {
            $etablissement = new Etablissement($etablissement['id_etablissement'], $etablissement['nom'], $etablissement['ville'], $etablissement['centre'], $etablissement['hebergement'], $etablissement['restauration']);
            $this->ajoutEtablissement($etablissement);
        }
    }

    public function getIdbyNom($nom)
    {

        for ($i = 0; $i < count($this->etablissements); $i++) {
            if ($this->etablissements[$i]->getNom() === $nom) {
                return $this->etablissements[$i]->getId();
            }
        }
    }
}

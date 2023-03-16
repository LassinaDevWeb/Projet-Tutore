<?php
require_once "Model.class.php";
require_once "Utilisateurs.class.php";


class UtilisateurManager extends Model
{

    private $utilisateurs;

    public function ajoutUtilisateur($utilisateur)
    {

        $this->utilisateurs[] = $utilisateur;
    }

    public function getUtilisateur()
    {
        return $this->utilisateurs;
    }

    public function chargementUtilisateur()
    {

        $sql = $this->getBdd()->prepare("SELECT id_user,roles,identifiant,password,nom_famille,prenom,numero,id_lieu,nom,ville FROM UTILISATEURS INNER JOIN ETABLISSEMENT ON UTILISATEURS.id_lieu = ETABLISSEMENT.id_etablissement");
        $sql->execute();
        $mesUtilisateurs = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesUtilisateurs as $utilisateur) {
            $utilisateur = new Utilisateurs($utilisateur['id_user'], $utilisateur['roles'], $utilisateur['identifiant'], $utilisateur['password'], $utilisateur['nom_famille'], $utilisateur['prenom'], $utilisateur['numero'], $utilisateur['id_lieu'], $utilisateur['nom'], $utilisateur['ville']);
            $this->ajoutUtilisateur($utilisateur);
        }
    }

    public function getRoleByUtilisateur($identifiant)
    {
        for ($i = 0; $i < count($this->utilisateurs); $i++) {
            if ($this->utilisateurs[$i]->getIdentifiant() === $identifiant) {
                return $this->utilisateurs[$i]->getRoles();
            }
        }
    }

    public function getUtilisateurByIdentifiantandpassword($identifiant, $password)
    {
        for ($i = 0; $i < count($this->utilisateurs); $i++) {
            if ($this->utilisateurs[$i]->getIdentifiant() === $identifiant) {
                if (password_verify($password, $this->utilisateurs[$i]->getPassword())) {
                    return true;
                } else {
                    echo $password;
                    echo nl2br("\n");
                    echo  $this->utilisateurs[$i]->getPassword();
                    echo nl2br("\n");
                    echo password_hash($password, PASSWORD_DEFAULT);
                }
            }
        }
    }

    public function getNameByUtilisateur($identifiant)
    {
        for ($i = 0; $i < count($this->utilisateurs); $i++) {
            if ($this->utilisateurs[$i]->getIdentifiant() === $identifiant) {
                return $this->utilisateurs[$i]->getPrenom();
            }
        }
    }

    public function getUtilisateurByIdentifiantandFirstnameandNumero($identifiant, $first_name, $numero)
    {
        for ($i = 0; $i < count($this->utilisateurs); $i++) {
            if ($this->utilisateurs[$i]->getIdentifiant() === $identifiant && $this->utilisateurs[$i]->getNom_famille() === $first_name && $this->utilisateurs[$i]->getNumero() === $numero) {

                return true;
            }
        }
    }
}

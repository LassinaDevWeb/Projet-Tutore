<?php
class Utilisateurs
{
    private $id_user;
    private $roles;
    private $identifiant;
    private $password;
    private $nom_famille;
    private $prenom;
    private $numero;
    private $id_lieu;
    private $nom;
    private $ville;

    public static $utilisateurs;

    public function __construct($id_user, $roles, $identifiant, $password, $nom_famille, $prenom, $numero, $id_lieu, $nom, $ville)
    {
        $this->id_user = $id_user;
        $this->roles = $roles;
        $this->identifiant = $identifiant;
        $this->password = $password;
        $this->nom_famille = $nom_famille;
        $this->prenom = $prenom;
        $this->numero = $numero;
        $this->id_lieu = $id_lieu;
        $this->nom = $nom;
        $this->ville = $ville;
        self::$utilisateurs[] = $this;
    }

    public function getId()
    {
        return $this->id_user;
    }
    public function setId($id_user)
    {
        return $this->id_user = $id_user;
    }

    public function getRoles()
    {
        return $this->roles;
    }
    public function setRoles($roles)
    {
        return $this->roles = $roles;
    }

    public function getIdentifiant()
    {
        return $this->identifiant;
    }
    public function setIdentifiant($identifiant)
    {
        return $this->identifiant = $identifiant;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        return $this->password = $password;
    }

    public function getNom_famille()
    {
        return $this->nom_famille;
    }
    public function setNom_famille($nom_famille)
    {
        return $this->nom_famille = $nom_famille;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        return $this->prenom = $prenom;
    }

    public function getNumero()
    {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        return $this->numero = $numero;
    }

    public function getId_lieu()
    {
        return $this->id_lieu;
    }
    public function setId_lieu($id_lieu)
    {
        return $this->id_lieu = $id_lieu;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getVille()
    {
        return $this->ville;
    }
}

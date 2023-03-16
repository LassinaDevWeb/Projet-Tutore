<?php

require "models/Atelier_cataManager.class.php";
require "models/UtilisateurManager.class.php";
require "models/Atelier_programManager.class.php";
require "models/EtablissementManager.class.php";
require "models/ParticiperManager.class.php";
require "models/Fiche_participantManager.class.php";

class abiController
{

    public function __construct()
    {
        $this->atelier_cataManager = new Atelier_cataManager;
        $this->atelier_cataManager->chargementAtelier_cata();

        $this->participerManager = new ParticiperManager;
        $this->participerManager->chargementParticiper();

        $this->fiche_participantManager = new Fiche_participantManager;
        $this->fiche_participantManager->chargementFiche_participant();

        $this->atelier_programManager = new Atelier_programManager;
        $this->atelier_programManager->chargementAtelier_program();

        $this->utilisateurManager = new UtilisateurManager;
        $this->utilisateurManager->chargementUtilisateur();

        $this->etablissementManager = new EtablissementManager;
        $this->etablissementManager->chargementEtablissement();
    }

    public function afficherAteliers_cata()
    {

        $ateliers_cata = $this->atelier_cataManager->getAteliers_cata();
        if (empty($ateliers_cata)) {

            $_SESSION['alert'] = [
                "type" => "warning",
                "msg" => "Attention, la bdd est vide."
            ];
            require "views/public_catalogue.view.php";
        } else {
            $ateliers_cata = $this->atelier_cataManager->getAteliers_cata();
            require "views/public_catalogue.view.php";
        }
    }

    public function connexion($identifiant, $password)
    {


        if (!isset($identifiant) || !isset($password)) {
            $_SESSION['alert'] = [
                "type" => "warning",
                "msg" => "Attention, tous les champs sont obligatoires."
            ];
        } else {

            $crypted = password_hash($password, PASSWORD_DEFAULT);

            $utilisateur = $this->utilisateurManager->getUtilisateurByIdentifiantandpassword($identifiant, $password);
            if (!empty($utilisateur)) {
                $role = $this->utilisateurManager->getRoleByUtilisateur($identifiant);
                $_SESSION['role'] = $role;
                $prenom = $this->utilisateurManager->getNameByUtilisateur($identifiant);
                $_SESSION['prenom'] = $prenom;
                require "views/accueil.view.php";
            } else {
                header("Location:accueil");
            }
        }
    }

    public function deconnexion()
    {

        unset($_SESSION['role']);
        unset($_SESSION['prenom']);
        require "views/accueil.view.php";
    }

    public function afficherAtelier_programAndEtablissementpublic()
    {
        $ateliers_program = $this->atelier_programManager->getAteliers_program();
        $etablissements = $this->etablissementManager->getEtablissement();
        if (empty($etablissements) || empty($ateliers_program)) {

            $_SESSION['alert'] = [
                "type" => "warning",
                "msg" => "Attention, la bdd est vide."
            ];
            require "views/public_program.view.php";
        } else {
            $etablissements = $this->etablissementManager->getEtablissement();
            $ateliers_program = $this->atelier_programManager->getAteliers_program();

            require "views/public_program.view.php";
        }
    }

    public function afficherAtelier_programandCentrepublic($centre)
    {
        $etablissements = $this->etablissementManager->getEtablissement();
        $id_organiser = $this->etablissementManager->getIdbyNom($centre);
        $ateliers_program = $this->atelier_programManager->getAtelier_programByCentre($id_organiser);
        if (empty($etablissements) || empty($ateliers_program)) {

            $ateliers_program = $this->atelier_programManager->getAteliers_program();
            $participant = $this->participerManager->getParticipers();
            require "views/public_program.view.php";
        } else {
            $ateliers_program = $this->atelier_programManager->getAtelier_programByCentre($id_organiser);
            $etablissements = $this->etablissementManager->getEtablissement();
            require "views/public_program.view.php";
        }
    }

    public function afficherAtelier_programAndEtablissementprivate()
    {

        $ateliers_program = $this->atelier_programManager->getAteliers_program();
        $etablissements = $this->etablissementManager->getEtablissement();
        if (empty($etablissements) || empty($ateliers_program)) {

            $_SESSION['alert'] = [
                "type" => "warning",
                "msg" => "Attention, la bdd est vide, veuillez ajouter un projet pour commencer."
            ];
            require "views/private_program.view.php";
        } else {
            $etablissements = $this->etablissementManager->getEtablissement();
            $ateliers_program = $this->atelier_programManager->getAteliers_program();
            $participant = $this->participerManager->getParticipers();

            require "views/private_program.view.php";
        }
    }

    public function afficherAtelier_programandCentreprivate($centre)
    {
        $etablissements = $this->etablissementManager->getEtablissement();
        $id_organiser = $this->etablissementManager->getIdbyNom($centre);
        $ateliers_program = $this->atelier_programManager->getAtelier_programByCentre($id_organiser);
        if (empty($etablissements) || empty($ateliers_program)) {

            $ateliers_program = $this->atelier_programManager->getAteliers_program();
            $participant = $this->participerManager->getParticipers();

            require "views/private_program.view.php";
        } else {
            $ateliers_program = $this->atelier_programManager->getAtelier_programByCentre($id_organiser);
            $etablissements = $this->etablissementManager->getEtablissement();
            $participant = $this->participerManager->getParticipers();
            require "views/private_program.view.php";
        }
    }

    public function suppressionAtelier_program($id)
    {
        $participant = $this->participerManager->getParticiperbyId_program($id);

        if (!empty($participant)) {
            $id_participation = $participant->getId_participation();
            $this->participerManager->suppressionParticiperBD($id);
            $this->fiche_participantManager->suppressionfiche_participant($id_participation);
            $this->atelier_programManager->suppressionAtelier_programBD($id);
            $ateliers_program =  $this->atelier_programManager->getAteliers_program();
            $etablissements = $this->etablissementManager->getEtablissement();
            header("Location:private_program");
        } else if (empty($participant)) {
            $this->atelier_programManager->suppressionAtelier_programBD($id);
            $ateliers_program =  $this->atelier_programManager->getAteliers_program();
            $etablissements = $this->etablissementManager->getEtablissement();

            header("Location:private_program");
        }
    }

    public function ajoutParticipantandFiche_participant($id_card, $email)
    {
        if (
            !empty(!htmlentities(!htmlspecialchars($_POST['prenom'])))
            && !empty(!htmlentities(!htmlspecialchars($_POST['adresse'])))
            && !empty(!htmlentities(!htmlspecialchars($_POST['nom'])))
            && !empty(!htmlentities(!htmlspecialchars($_POST['date_naissance'])))
            && !empty(!htmlentities(!htmlspecialchars($_POST['diplome'])))
            && !empty(!htmlentities(!htmlspecialchars($_POST['telephone'])))
            && !empty(!htmlentities(!htmlspecialchars($id_card)))
            && !empty(!htmlentities(!htmlspecialchars($_POST['ville'])))
            && !empty(!htmlentities(!htmlspecialchars($email)))
            && filter_var($email, FILTER_VALIDATE_EMAIL)
            && strpos($email, '@')
        ) {
            $this->fiche_participantManager->ajoutFiche_participantBD($_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['adresse'], $_POST['ville'], $email, $_POST['diplome'], $_POST['telephone']);
            $id_fiche_participant = $this->fiche_participantManager->getIdbyEmail($email);

            if (!empty($id_fiche_participant)) {
                $this->participerManager->ajoutParticiperBD($id_card, $id_fiche_participant);
                $ateliers_program =  $this->atelier_programManager->getAteliers_program();
                $etablissements = $this->etablissementManager->getEtablissement();
                header("Location:private_program");
            } else {
                header("Location:private_program");
            }
        } else {
            header("Location:private_program");
        }
    }

    public function trombino()
    {
        if (!empty($_SESSION['role'])) {
            $trombino = $this->utilisateurManager->getUtilisateur();

            if (empty($trombino)) {

                $_SESSION['alert'] = [
                    "type" => "warning",
                    "msg" => "Attention, la bdd est vide, veuillez ajouter un projet pour commencer."
                ];
                require "views/trombino.view.php";
            } else {


                $trombino = $this->utilisateurManager->getUtilisateur();
                require "views/trombino.view.php";
            }
        } else {
            header("Location:accueil");
        }
    }

    public function create_atelier()
    {
        if (!empty($_SESSION['role'])) {
            require "views/create_atelier.view.php";
        } else {
            header("Location:accueil");
        }
    }

    public function verif_create_atelier()
    {
        $titre = isset($_POST['titre']) ? $_POST['titre'] : ' ';

        $contenu = isset($_POST['contenu']) ? $_POST['contenu'] : ' ';

        $duree = isset($_POST['duree']) ? $_POST['duree'] : ' ';

        $prerequis =  isset($_POST['prerequis']) ? $_POST['prerequis'] : ' ';

        $objectif = isset($_POST['objectif']) ? $_POST['objectif'] : ' ';

        $nomficher = basename($_FILES["image"]["name"]);



        if (
            !empty(!htmlentities(!htmlspecialchars($titre)))
            && !empty(!htmlentities(!htmlspecialchars($contenu)))
            && !empty(!htmlentities(!htmlspecialchars($duree)))
            && !empty(!htmlentities(!htmlspecialchars($prerequis)))
            && !empty(!htmlentities(!htmlspecialchars($objectif)))
        ) {
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $error = 1;

                // verification de la taille de l'image
                if ($_FILES['image']['size'] <= 3000000) {
                    $infoImage = pathinfo($_FILES['image']['name']);
                    $extensionImage = $infoImage['extension'];
                    $extensionsArray = array('png', 'gif', 'jpg', 'jpeg');
                }
                $this->atelier_cataManager->ajoutAtelier_cataBD($contenu, $duree, $prerequis, $nomficher, $objectif, $titre);
                $atelier_catabytitre = $this->atelier_cataManager->getAtelier_cataByTitre($titre);
                $id = $atelier_catabytitre->getId();
                $img = $atelier_catabytitre->getImage();
                if (in_array($extensionImage, $extensionsArray)) {  // le type de l'image correspond à ce que l'on attend, on peut alors l'envoyer sur notre serveur

                    $address = 'public/images/' . $id . '-' . $img;
                    move_uploaded_file($_FILES['image']['tmp_name'], $address); // on renomme notre image avec une clé unique suivie du nom du fichier

                    $error = 0;
                }

                header("Location:private_catalogue");
            } else {
                header("Location:create_atelier");
            }
        }
    }

    public function publication_atelier()
    {
        if (!empty($_SESSION['role'])) {
            $ateliers_cata = $this->atelier_cataManager->getAteliers_cata();
            $etablissements = $this->etablissementManager->getEtablissement();
            require "views/publication_atelier.view.php";
        } else {
            header("Location:accueil");
        }
    }

    public function verif_publication_atelier()
    {
        $date_heure = isset($_POST['date_heure']) ? $_POST['date_heure'] : ' ';

        $mini = isset($_POST['mini']) ? $_POST['mini'] : ' ';

        $max =  isset($_POST['max']) ? $_POST['max'] : ' ';

        $atelier = isset($_POST['atelier']) ? $_POST['atelier'] : ' ';


        $derouler = isset($_POST['derouler']) ? $_POST['derouler'] : ' ';


        $organiser = isset($_POST['organiser']) ? $_POST['organiser'] : ' ';
        if (
            !empty(!htmlentities(!htmlspecialchars($date_heure)))
            && !empty(!htmlentities(!htmlspecialchars($mini)))
            && !empty(!htmlentities(!htmlspecialchars($max)))
            && !empty(!htmlentities(!htmlspecialchars($atelier)))
            && !empty(!htmlentities(!htmlspecialchars($derouler)))
            && !empty(!htmlentities(!htmlspecialchars($organiser)))
        ) {
            $id_derouler = $this->etablissementManager->getIdbyNom($derouler);
            $id_organiser = $this->etablissementManager->getIdbyNom($organiser);
            $id_cata = $this->atelier_cataManager->getIdbyTitre($atelier);

            $this->atelier_programManager->ajoutAtelier_programBD($date_heure, $mini, $max, $id_derouler, $id_cata, $id_organiser);

            header("Location:private_program");
        }
    }

    public function private_catalogue()
    {
        if (!empty($_SESSION['role'])) {
            $ateliers_cata = $this->atelier_cataManager->getAteliers_cata();
            if (empty($ateliers_cata)) {

                $_SESSION['alert'] = [
                    "type" => "warning",
                    "msg" => "Attention, la bdd est vide, veuillez ajouter un projet pour commencer."
                ];
                require "views/private_catalogue.view.php";
            } else {
                $ateliers_cata = $this->atelier_cataManager->getAteliers_cata();
                require "views/private_catalogue.view.php";
            }
        } else {
            header("Location:accueuil");
        }
    }

    public function supprimer_atelier_cata()
    {
        $atelier_cata = $this->atelier_cataManager->getAtelier_cataById($_POST['id_card_cata']);
        $image = $atelier_cata->getId() . '-' . $atelier_cata->getImage();
        $atelier_programid_cata = $this->atelier_programManager->getAtelier_programById_cata($_POST['id_card_cata']);
        if (!empty($atelier_programid_cata)) {
            $participant = $this->participerManager->getParticipantbyId_program($atelier_programid_cata->getId());
        }

        if (empty($atelier_programid_cata)) {
            unlink('public/images/' . $image);
            $this->atelier_cataManager->suppressionAtelier_cataBD($_POST['id_card_cata']);
            header("Location:private_catalogue");
        } elseif (!empty($participant) && !empty($atelier_programid_cata)) {
            $this->participerManager->suppressionParticiperBD($atelier_programid_cata->getId());
            $this->atelier_programManager->suppressionAtelier_programid_cata($_POST['id_card_cata']);
            unlink('public/images/' . $image);
            $this->atelier_cataManager->suppressionAtelier_cataBD($_POST['id_card_cata']);
            header("Location:private_catalogue");
        } elseif (!empty($atelier_programid_cata)) {
            $this->atelier_programManager->suppressionAtelier_programid_cata($_POST['id_card_cata']);
            unlink('public/images/' . $image);
            $this->atelier_cataManager->suppressionAtelier_cataBD($_POST['id_card_cata']);
            header("Location:private_catalogue");
        }
    }

    public function supprimer_participant()
    {
        $id_jeune = $_POST['id_participant'];

        $this->participerManager->suppressionParticiperBDbyId_participation($id_jeune);
        //  if (empty($this->participerManager->getParticiperbyId_participation($id_jeune))) {

        $this->fiche_participantManager->suppressionfiche_participant($id_jeune);
        header("Location:private_program");
        //    }
    }
}

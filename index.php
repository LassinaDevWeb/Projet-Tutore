<?php
session_start();
require_once "controllers/controller.php";
$abiController = new abiController;

if (empty($_GET['page'])) {
    require "views/accueil.view.php";
} else {
    switch ($_GET['page']) {
        case "accueil":
            require "views/accueil.view.php";
            break;
        case "public_catalogue":
            $abiController->afficherAteliers_cata();
            break;
        case "public_prog":
            $abiController->afficherAtelier_programAndEtablissementpublic();

            break;
        case "connexion":
            $abiController->connexion($_POST["identifiant"], $_POST["password"]);
            break;
        case "deconnexion":
            $abiController->deconnexion();
            break;

        case "public_prog_centre":
            $abiController->afficherAtelier_programandCentrepublic($_POST["nom_centre"]);
            break;

        case "private_program":
            $abiController->afficherAtelier_programAndEtablissementprivate();
            break;

        case "private_prog_centre":
            $abiController->afficherAtelier_programandCentreprivate($_POST["nom_centre"]);
            break;

        case "supprimer_atelier_program":
            $abiController->suppressionAtelier_program($_POST["id_card_prog"]);
            break;

        case "inscription":
            $abiController->ajoutParticipantandFiche_participant($_POST["id_card_prog"], $_POST["email"]);
            break;

        case "trombino":
            $abiController->trombino();
            break;

        case "create_atelier":
            $abiController->create_atelier();
            break;

        case "verif_create_atelier":
            $abiController->verif_create_atelier();
            break;

        case "publication_atelier":
            $abiController->publication_atelier();
            break;

        case "verif_publication_atelier":
            $abiController->verif_publication_atelier();
            break;

        case "private_catalogue":
            $abiController->private_catalogue();
            break;

        case "supprimer_atelier_cata":
            $abiController->supprimer_atelier_cata();
            break;
        case "supprimer_participant":
            $abiController->supprimer_participant();
            break;
    }
}

<?php ob_start();

?>

<body>
    <header>

        <nav class="navbar navbar-expand-lg " id="navbar">
            <div class="container-fluid">



                <img src="../public/images/logo.png" class="img-fluid rounded mx-auto d-block" alt="logo" height="250" width="250">
                <?php if (!empty($_SESSION['role'])) {
                    // Affichage d'un menu si un utilisateur est connecté 
                ?>

                    <div class="dropdown dropleft ">
                        <a href="#" class="dropdown-toggle btn btn-link lien_nav  " data-toggle="dropdown" class="Text"><?php echo $_SESSION['prenom']; ?></a>
                        <ul class="dropdown-menu" role="menu">
                            <div class="container col-sm-12" style="padding: 5px;">


                                <a href="accueil" class="btn btn-outline-success">Partie public</a>





                                <form action="deconnexion" method="POST">
                                    <input type="submit" name="btnDeco" value="Se deconnecter" class="btn btn-outline-danger">
                                </form>
                            </div>
                        </ul>
                    </div>
                <?php
                }
                ?>

            </div>


    </header>
    <main>
        <div class="row mt-5">

            <div class="col-3 mt-5">

                <div class="row ml-3">
                    <aside class="col">

                        <div class="mt-5">

                            <a href="private_program" class="btn btn-link lien_nav" class="text"><b>Inscription</b></a>

                        </div>

                        <br>


                        <div class="mt-5">



                            <a href="trombino" class="btn btn-link lien_nav" class="text">Trombinoscope</a>


                        </div>

                        <br>
                        <?php
                        if (!empty($_SESSION['role'])) {

                            if ($_SESSION['role'] == 'coordinateur') {
                                // affichage de lien dans le menu latéral selon le role de l'utilisateur
                        ?>
                                <div class="">
                                    <a href="create_atelier" class="btn btn-link lien_nav  " class="Text">Creation<br>Atelier</a>

                                </div>
                                <br>
                                <div class="mt-5">

                                    <a href="publication_atelier" class="btn btn-link lien_nav" class="text">Programmation<br>Ateliers</a>

                                </div>



                                <br>
                                <div class="mt-5">

                                    <a href="private_catalogue" class="btn btn-link lien_nav  " class="Text">catalogue<br>Ateliers</a>

                                </div>
                        <?php
                            }
                        }
                        ?>
                    </aside>
                </div>

            </div>

            <section class="col-8 ml-2">

                <h1 class="text-center text-success mt-4">Ateliers Programmés</h1>

                <div class="container">
                    <form class="d-flex" method="post" action="private_prog_centre">
                        <select class="form-control " id="nom_centre" name="nom_centre" type="text" placeholder="Entrez un centre AFPA ">
                            <option>Tous les centres</option>
                            <?php
                            for ($i = 0; $i < count($etablissements); $i++) :

                                if ($etablissements[$i]->getCentre() > 0) {



                            ?>
                                    <option><?php echo $etablissements[$i]->getNom(); ?></option>
                            <?php
                                }
                            endfor;
                            ?>


                        </select>
                        <?php
                        if (!empty($ateliers_program)) {
                        ?>
                            <button class="btn btn-success" type="submit">Recherche</button>
                        <?php
                        }
                        ?>
                    </form>
                </div>
                <br>

                <div class="row">
                    <?php
                    if (!empty($ateliers_program)) {
                        for ($i = 0; $i < count($ateliers_program); $i++) :


                    ?>
                            <div class="col-md-4 col-lg-4 col-sm-4 mt-4 ml-2 mb-4">
                                <div class="card border-success " style="max-width: 18rem;">
                                    <div class="card-header font-weight-bold"><?php echo $ateliers_program[$i]->getTitre(); ?></div>
                                    <div class="card-body">
                                        <h5 class="card-title text-success">Le <?php echo $ateliers_program[$i]->getDate_jour_heure(); ?></h5>
                                        <button class="btn btn-dark col-12 col-sm-12 col-md-12" data-toggle='collapse' data-target='#myCard<?php echo $ateliers_program[$i]->getId(); ?>' aria-expanded="false" aria-controls="myCard<?php echo $ateliers_program[$i]->getId(); ?>">Information</button>

                                        <div class="collapse row" id="myCard<?php echo $ateliers_program[$i]->getId(); ?>">
                                            <p class="card-text text-success col-6 col-sm-12 col-md-12"> minimum : </p>
                                            <p class="font-weight-bold font-italic"><?php echo $ateliers_program[$i]->getNombre_mini(); ?></p>
                                            <p class="card-text text-success col-6 col-sm-12 col-md-12"> maximum : </p>
                                            <p class="font-weight-bold font-italic"><?php echo $ateliers_program[$i]->getNombre_max(); ?></p>
                                            <p class="card-text text-success col-6 col-sm-12 col-md-12">Contenu :</p>
                                            <p class="font-weight-bold font-italic"><?php echo $ateliers_program[$i]->getContenu(); ?></p>
                                            <p class="card-text text-success col-6 col-sm-12 col-md-12">Objectif : </p>
                                            <p class="font-weight-bold font-italic"><?php echo $ateliers_program[$i]->getObjectif(); ?></p>
                                            <p class="card-text text-success col-6 col-sm-12 col-md-12">Prérequis : </p>
                                            <p class="font-weight-bold font-italic"><?php echo $ateliers_program[$i]->getPrerequis(); ?></p>
                                            <p class="card-text text-success col-6 col-sm-12 col-md-12">Durée :</p>
                                            <p class="font-weight-bold font-italic"><?php echo $ateliers_program[$i]->getDate_duree(); ?></p>
                                            <?php


                                            if ($_SESSION['role'] == 'coordinateur') {
                                                // affichage boutton supprimer si le role de l'utilisateur est 'coordinateur '
                                            ?>
                                                <form class="col-6 col-sm-12 col-md-12" action="supprimer_atelier_program" method="post">
                                                    <input id="id_card_prog" name="id_card_prog" type="hidden" value="<?php echo $ateliers_program[$i]->getId(); ?>">
                                                    <input type="submit" name="delete" value="Supprimer" class="btn btn-outline-danger">
                                                </form>
                                            <?php
                                            }
                                            $modal2 = $ateliers_program[$i]->getId() + 100;
                                            if ($_SESSION['role'] == 'coordinateur' || $_SESSION['role'] == 'conseil') {

                                            ?>

                                                <div class="col-6 col-sm-12 col-md-12 mt-2">

                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#Modal<?php echo $ateliers_program[$i]->getId(); ?>">
                                                        Inscription
                                                    </button>

                                                </div>

                                            <?php
                                            }
                                            ?>

                                            <div class="modal fade bd-example-modal-lg" id="Modal<?php echo  $ateliers_program[$i]->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel<?php echo  $ateliers_program[$i]->getId(); ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header header_modal">
                                                            <h5 class="modal-title " id="ModalLabel<?php echo  $ateliers_program[$i]->getId(); ?>">Fiche d'inscription pour <?php echo  $ateliers_program[$i]->getTitre(); ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form action="inscription" method="post">

                                                                <div class="row">


                                                                    <div class="form-group col-6">
                                                                        <label for="email"> adresse Email:</label>
                                                                        <input type="email" class="form-control" placeholder="Enter email" id="email" name="email">
                                                                    </div>

                                                                    <div class="form-group col-6">
                                                                        <label for="nom">Nom</label>
                                                                        <input type="text" name="nom" class="form-control" id="nom" placeholder="nom">
                                                                    </div>

                                                                    <div class="form-group col-6">
                                                                        <label for="prenom">Prenom</label>
                                                                        <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Prenom">
                                                                    </div>

                                                                    <div class="form-group col-6">
                                                                        <label for="date_naissance">Date de naissance</label>
                                                                        <input type="date" name="date_naissance" class="form-control" id="date_naissance" placeholder="Date de naissance">
                                                                    </div>

                                                                    <div class="form-group col-6">
                                                                        <label for="adresse">Adresse</label>
                                                                        <input type="text" name="adresse" class="form-control" id="adresse" placeholder="Adresse">
                                                                    </div>

                                                                    <div class="form-group col-6">
                                                                        <label for="ville">Ville</label>
                                                                        <input type="text" name="ville" class="form-control" id="ville" placeholder="Ville">
                                                                    </div>

                                                                    <div class="form-group col-6">
                                                                        <label for="diplome">diplome</label>
                                                                        <select type="text" name="diplome" class="form-control" id="diplome">
                                                                            <option>Aucun diplome</option>
                                                                            <option>Bac</option>
                                                                            <option>Bac+1</option>
                                                                            <option>Bac+2</option>
                                                                            <option>Bac+3</option>
                                                                            <option>Bac+4</option>
                                                                            <option>Bac+5</option>
                                                                        </select>
                                                                    </div>


                                                                    <div class="form-group col-6">
                                                                        <label for="telephone">Numero de telephone</label>
                                                                        <input type="tel" name="telephone" class="form-control" id="telephone" placeholder="Numero de telephone">
                                                                    </div>

                                                                    <input id="id_card_prog" name="id_card_prog" type="hidden" value="<?php echo  $ateliers_program[$i]->getId(); ?>">


                                                                </div>
                                                                <div class="modal-footer">

                                                                    <button type="submit" value="button" class="btn btn-success btn-lg btn-block mt-3">Inscription</button>

                                                                </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($_SESSION['role'] == 'coordinateur' || $_SESSION['role'] ==  'formatrice' || $_SESSION['role'] ==  'conseil') {
                                            ?>
                                                <div class="col-6 col-sm-12 col-md-12 mt-2">
                                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#Modal<?php echo $modal2; ?>">
                                                        liste inscrits
                                                    </button>



                                                </div>

                                            <?php
                                            }

                                            ?>
                                            <div class="modal fade bd-example-modal-lg" id="Modal<?php echo $modal2; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel<?php echo $modal2; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header header_modal">
                                                            <h5 class="modal-title " id="ModalLabel<?php echo $modal2; ?>">liste d'inscrits pour atelier <?php echo $ateliers_program[$i]->getTitre(); ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                                                                <table class="table">
                                                                    <thead class="thead-dark">
                                                                        <tr>
                                                                            <th scope="col">Nom</th>
                                                                            <th scope="col">Prenom</th>
                                                                            <th scope="col">Date de naissance</th>
                                                                            <th scope="col">Adresse</th>
                                                                            <th scope="col">Ville</th>
                                                                            <th scope="col">Email</th>
                                                                            <th scope="col">Telephone</th>
                                                                            <th scope="col">diplome</th>
                                                                            <th scope="col"> Supprimer</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        if (!empty($participant)) {



                                                                            for ($a = 0; $a < count($participant); $a++) :

                                                                                if ($participant[$a]->getId_program() == $ateliers_program[$i]->getId()) {


                                                                        ?>

                                                                                    <tr>
                                                                                        <th scope="row"><?php echo $participant[$a]->getNom() ?></th>
                                                                                        <td><?php echo $participant[$a]->getPrenom() ?></td>
                                                                                        <td><?php echo $participant[$a]->getDate_naissance() ?> </td>
                                                                                        <td><?php echo $participant[$a]->getAdresse() ?></td>
                                                                                        <td><?php echo $participant[$a]->getVille() ?></td>
                                                                                        <td><?php echo $participant[$a]->getEmail() ?></td>
                                                                                        <td><?php echo $participant[$a]->getTelephone() ?></td>
                                                                                        <td><?php echo $participant[$a]->getDiplome() ?></td>
                                                                                        <td>
                                                                                            <form action="supprimer_participant" method="post">
                                                                                                <input id="id_participant" name="id_participant" type="hidden" value="<?php echo $participant[$a]->getId_participation(); ?>">
                                                                                                <input type="submit" name="delete" value="Supprimer" class="btn btn-outline-danger btn-sm">
                                                                                            </form>
                                                                                        </td>
                                                                                    </tr>

                                                                            <?php
                                                                                }
                                                                            endfor;
                                                                        } elseif (empty($participant)) {
                                                                            ?>
                                                                            <h3 class="ml-5 mt-5 bg-secondary"><b>Aucun participant pour cette formation Programmé !</b></h3>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endfor;
                    } elseif (empty($ateliers_program)) {
                        ?>
                        <h3 class="ml-5 mt-5 bg-secondary"><b>Aucune formation Programmé pour le moment !</b></h3>
                    <?php
                    }
                    ?>
                </div>



            </section>

        </div>
    </main>












    <?php
    $content = ob_get_clean();
    $titre = "Inscription";
    require "template.view.php";

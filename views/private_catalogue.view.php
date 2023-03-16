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

                            <a href="private_program" class="btn btn-link lien_nav" class="text">Inscription</a>

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
                                    <a href="create_atelier" class="btn btn-link lien_nav  " class="Text"><b>Creation<br>Atelier</b></a>

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
                <div class="row">
                    <?php
                    if (!empty($ateliers_cata)) {


                        for ($i = 0; $i < count($ateliers_cata); $i++) :
                    ?>
                            <div class="col-md-4 col-lg-4 col-sm-4 mt-4 ml-2 mb-4">
                                <div class="card border-success " style="max-width: 18rem;">
                                    <div class="card-header font-weight-bold"><?php echo $ateliers_cata[$i]->getTitre(); ?></div>
                                    <img class="card-img-top " src="../public/images/<?php echo $ateliers_cata[$i]->getId(); ?>-<?php echo $ateliers_cata[$i]->getImage(); ?>">
                                    <div class="card-body">

                                        <button class="btn btn-dark col-12 col-sm-12 col-md-12" data-toggle='collapse' data-target='#myCard<?php echo $ateliers_cata[$i]->getId(); ?>' aria-expanded="false" aria-controls="myCard<?php echo $ateliers_cata[$i]->getId(); ?>">Information</button>

                                        <div class="collapse row" id="myCard<?php echo $ateliers_cata[$i]->getId(); ?>">
                                            <p class="card-text text-success col-6 col-sm-12 col-md-12">Contenu :</p>
                                            <p class="font-weight-bold font-italic"><?php echo $ateliers_cata[$i]->getContenu(); ?></p>
                                            <p class="card-text text-success col-6 col-sm-12 col-md-12">Objectif : </p>
                                            <p class="font-weight-bold font-italic"><?php echo $ateliers_cata[$i]->getObjectif(); ?></p>
                                            <p class="card-text text-success col-6 col-sm-12 col-md-12">Prérequis : </p>
                                            <p class="font-weight-bold font-italic"><?php echo $ateliers_cata[$i]->getPrerequis(); ?></p>
                                            <p class="card-text text-success col-6 col-sm-12 col-md-12">Durée :</p>
                                            <p class="font-weight-bold font-italic"><?php echo $ateliers_cata[$i]->getDate_duree(); ?></p>

                                            <form class="col-6 col-sm-12 col-md-12" action="supprimer_atelier_cata" method="post">
                                                <input id="id_card_cata" name="id_card_cata" type="hidden" value="<?php echo $ateliers_cata[$i]->getId(); ?>">
                                                <input type="submit" name="delete" value="Supprimer" class="btn btn-outline-danger">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endfor;
                    } elseif (empty($ateliers_cata)) {
                        ?>
                        <h3 class="ml-5 mt-5 bg-secondary"><b>Aucune formation dans le catalogue pour le moment !</b></h3>
                    <?php
                    }
                    ?>
                </div>



            </section>

        </div>
    </main>












    <?php
    $content = ob_get_clean();
    $titre = "Creation Atelier Catalogue";
    require "template.view.php";

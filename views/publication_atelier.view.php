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
                                    <a href="create_atelier" class="btn btn-link lien_nav  " class="Text">Creation<br>Atelier</a>

                                </div>
                                <br>
                                <div class="mt-5">

                                    <a href="publication_atelier" class="btn btn-link lien_nav" class="text"><b></b>Programmation<br>Ateliers</b></a>

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
                <h1 class="text-center text-success mt-4">Programmation d'Atelier</h1>
                <!-- Formulaire pour la création d'ateliers programmées -->
                <form action="verif_publication_atelier" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="form-group col-6">
                            <label for="date_heure">date - heure</label>
                            <input type="datetime-local" name="date_heure" class="form-control input" id="date_heure" placeholder="Date - Heure">
                        </div>


                        <div class="form-group col-6">
                            <label for="mini">Nombre minimum</label>
                            <input type="number" name="mini" class="form-control input" id="mini" placeholder="nombre Minimum">
                        </div>


                        <div class="form-group col-6">
                            <label for="max">Nombre maximum</label>
                            <input type="number" name="max" class="form-control input" id="max" placeholder="Nombre maximum" max="30">
                        </div>


                        <div class="form-group col-6">
                            <label for="atelier">Ateliers</label>
                            <select name="atelier" class="form-control" id="atelier" type="text">
                                <?php
                                for ($i = 0; $i < count($ateliers_cata); $i++) :
                                ?>
                                    <option><?php echo $ateliers_cata[$i]->getTitre(); ?></option>
                                <?php
                                endfor;
                                ?>




                            </select>

                        </div>

                        <div class="form-group col-6">
                            <label for="derouler">Derouler</label>
                            <select class="form-control" name="derouler" id="derouler" type="text">
                                <?php
                                for ($i = 0; $i < count($etablissements); $i++) :


                                    // si la valeur de l'attribut "centre" est égale à 0 on affiche le nom de l'établissement dans le select



                                ?>
                                    <option><?php echo $etablissements[$i]->getNom(); ?></option>
                                <?php

                                endfor;
                                ?>

                            </select>
                        </div>

                        <div class="from-group col-3">
                            <label for="organiser">Organiser</label>
                            <select class="form-control " id="organiser" name="organiser" type="text">
                                <?php
                                for ($i = 0; $i < count($etablissements); $i++) :

                                    if ($etablissements[$i]->getCentre() > 0) {
                                        // si la valeur de l'attribut "centre" est égale à 0 on affiche le nom de l'établissement dans le select



                                ?>
                                        <option><?php echo $etablissements[$i]->getNom(); ?></option>
                                <?php
                                    }
                                endfor;
                                ?>
                            </select>
                        </div>

                        <div class="container">
                            <button type="submit" value="button" id="submit" class="btn btn-success btn-lg btn-block mt-3">Publication</button>
                        </div>
                    </div>
                </form>
                <p id="erreur1"></p>
                <br>
                <p id="erreur2"></p>





            </section>

        </div>
    </main>












    <?php
    $content = ob_get_clean();
    $titre = "Publication d'atelier";
    require "template.view.php";

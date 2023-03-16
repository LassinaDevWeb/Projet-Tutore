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
                <h1 class="text-center text-success  mt-4">Création d'Atelier dans le catalogue</h1>
                <!-- formulaire de création d'ateliers   -->
                <form action="verif_create_atelier" method="post" enctype="multipart/form-data">
                    <div class="row">


                        <div class="form-group col-6">
                            <label for="titre">Titre</label>
                            <input type="text" name="titre" class="form-control input" id="titre" placeholder="Titre" required>
                        </div>


                        <div class="form-group col-6">
                            <label for="duree">Durée</label>
                            <input type="time" name="duree" class="form-control input" id="duree" required>
                        </div>


                        <div class="form-group col-6">
                            <label for="prerequis">Prérequis</label>
                            <input type="text" name="prerequis" class="form-control input" id="prerequis" placeholder="Prérequis" required>
                        </div>



                        <div class="form-group col-6">
                            <label for="objectif">Objectif</label>
                            <input type="text" name="objectif" class="form-control input" id="objectif" placeholder="Objectif" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="contenu">Contenu</label>
                            <textarea name="contenu" class="form-control input" id="contenu" required></textarea>
                        </div>

                        <div class="form-group col-6 mt-5">

                            <input type="file" class="custom-file-input input" name="image" id="CustomFile">
                            <label class="custom-file-label" for="CustomFile">Choisir une images</label>
                        </div>


                        <div class="container">
                            <button type="submit" value="button" id="submit" class="btn btn-success btn-lg btn-block mt-3">Création</button>
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
    $titre = "Creation Atelier Catalogue";
    require "template.view.php";

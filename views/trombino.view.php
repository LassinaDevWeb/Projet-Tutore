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



                            <a href="" class="btn btn-link lien_nav" class="text"><b>Trombinoscope</b></a>


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

                <h1 class="text-center text-success mt-4"><i><u>Trombinoscope</u></i></h1>


                <div class="row">
                    <?php
                    for ($i = 0; $i < count($trombino); $i++) :
                        // affichage de toute les cards selon la base de donnée
                    ?>
                        <div class="col-md-4 col-lg-4 col-sm-4 mt-4 ml-2 mb-4">
                            <div class="card border-success " style="max-width: 18rem;">
                                <div class="card-header font-weight-bold"><?php echo $trombino[$i]->getIdentifiant(); ?></div>
                                <div class="card-body">



                                    <div class="row" id="myCard<?php echo $row['id_user']; ?>">
                                        <p class="card-text text-success col-6 col-sm-12 col-md-12"> Nom de famille:</p>
                                        <p class="font-weight-bold font-italic"><?php echo $trombino[$i]->getNom_famille(); ?></p>
                                        <p class="card-text text-success col-6 col-sm-12 col-md-12"> Prénom:</p>
                                        <p class="font-weight-bold font-italic"><?php echo $trombino[$i]->getPrenom(); ?></p>
                                        <p class="card-text text-success col-6 col-sm-12 col-md-12"> Numéro:</p>
                                        <p class="font-weight-bold font-italic"><?php echo $trombino[$i]->getNumero(); ?></p>
                                        <p class="card-text text-success col-6 col-sm-12 col-md-12"> Rôle:</p>
                                        <p class="font-weight-bold font-italic"><?php echo $trombino[$i]->getRoles(); ?></p>
                                        <p class="card-text text-success col-6 col-sm-12 col-md-12"> Appartient : </p>
                                        <p class="font-weight-bold font-italic"><?php echo $trombino[$i]->getNom(); ?></p>
                                        <p class="card-text text-success col-6 col-sm-12 col-md-12">Ville : </p>
                                        <p class="font-weight-bold font-italic"><?php echo $trombino[$i]->getVille(); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endfor;
                    ?>
                </div>




            </section>

        </div>
    </main>












    <?php
    $content = ob_get_clean();
    $titre = "Inscription";
    require "template.view.php";

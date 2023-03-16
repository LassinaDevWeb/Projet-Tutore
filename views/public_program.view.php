<?php ob_start();

?>

<body class="body_public">
    <header>

        <nav class="navbar navbar-expand-lg " id="navbar">
            <div class="container-fluid">



                <h1 class="logo"><i>Déclic pour l'action</i></h1>
                <?php if (!empty($_SESSION['role'])) {
                    // Affichage d'un menu si un utilisateur est connecté 
                ?>

                    <div class="dropdown dropleft ">
                        <a href="#" class="dropdown-toggle btn btn-link lien_nav  " data-toggle="dropdown" class="Text"><?php echo $_SESSION['prenom']; ?></a>
                        <ul class="dropdown-menu" role="menu">
                            <div class="container col-sm-12" style="padding: 5px;">


                                <a href="private_program" class="btn btn-outline-success">Partie privé</a>





                                <form action="deconnexion" method="POST">
                                    <input type="submit" name="btnDeco" value="Se deconnecter" class="btn btn-outline-danger">
                                </form>
                            </div>
                        </ul>
                    </div>
                <?php
                } else {
                ?>
                    <div class="dropdown dropleft ">
                        <a href="#" class="dropdown-toggle btn btn-link lien_nav  " data-toggle="dropdown" class="Text">Connexion</a>
                        <ul class="dropdown-menu" role="menu">
                            <div class="container col-sm-12" style="padding: 5px;">

                                <form method="POST" action="connexion" enctype="multipart/form-data">>
                                    <div class="form-group">
                                        <label for="indentifiant">Indentifiant:</label>
                                        <input type="text" class="form-control input" id="identifiant" placeholder="Entrer votre identifiant" name="identifiant" style="text-align : center;" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mot de passe:</label>
                                        <input type="password" class="form-control input" id="password" placeholder="Enter votre mot de passe" name="password" style="text-align : center;" required>
                                    </div>
                                    <button type="submit" class="btn btn-dark">Connexion</button>
                                </form>
                                <p id="erreur2"></p>
                            </div>
                        </ul>
                    </div>
                <?php
                }
                ?>


            </div>
        </nav>


        </nav>

        <nav class=" navbar-expand-lg" id="item">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <a href="#" class="btn btn-link lien_nav  " class="Text"> Atelier programmés</a>
                    </div>

                    <div class="col-4 ">
                        <a href="public_catalogue" class="btn btn-link lien_nav  " class="Text"> catalogue d'Ateliers</a>
                    </div>

                    <div class="col-4 ">
                        <a href="accueil" class="btn btn-link lien_nav  " class="Text"> <b> Accueil </b></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>

        <h1 class="text-center  mb-4 mt-4"><i><u> Ateliers Programmés</u></i></h1>

        <div class="container">
            <!-- Formulaire qui permet d'afficher les établissement qui sont des centres -->
            <form class="d-flex" method="post" action="public_prog_centre">
                <select class="form-control " id="nom_centre" name="nom_centre" type="text" placeholder="Entrez un centre AFPA ">
                    <option>Tous les centres</option>
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
                <?php
                if (!empty($ateliers_program)) {
                ?>
                    <button class="btn btn-success" type="submit">Recherche</button>
                <?php
                }
                ?>
            </form>
        </div>


        <div class="row">
            <?php
            if (!empty($ateliers_program)) {


                for ($i = 0; $i < count($ateliers_program); $i++) :


            ?>
                    <div class="col-md-3 col-lg-3 col-sm-5 mt-3 ml-1 mb-3">
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

                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endfor;
            } elseif (empty($ateliers_program)) {
                ?>
                <h3 class="ml-5 mt-5 bg-light"><b>Aucune formation Programmé pour le moment !</b></h3>
            <?php
            }
            ?>
        </div>









    </main>


    <?php
    $content = ob_get_clean();
    $titre = "public programmation";
    require "template.view.php";
    ?>
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





                                <form action="deconnexion" method="post">
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

                                <form action="connexion" method="post">
                                    <div class="form-group">
                                        <label for="indentifiant">Indentifiant:</label>
                                        <input type="text" class="form-control input" id="identifiant" placeholder="Entrer votre identifiant" name="identifiant" style="text-align : center;" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Mot de passe:</label>
                                        <input type="password" class="form-control input" id="password" placeholder="Enter votre mot de passe" name="password" style="text-align : center;" required>
                                    </div>
                                    <button type="submit" name="connect" id="submit" class="btn btn-dark">Connexion</button>
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


        <nav class=" navbar-expand-lg" id="item">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <a href="public_prog" class="btn btn-link lien_nav  " class="Text"> Atelier programmés</a>
                    </div>

                    <div class="col-4 ">
                        <a href="#" class="btn btn-link lien_nav  " class="Text"><b> catalogue d'Ateliers</b></a>
                    </div>

                    <div class="col-4 ">
                        <a href="accueil" class="btn btn-link lien_nav  " class="Text"> Accueil </a>
                    </div>
                </div>
            </div>
        </nav>


    </header>

    <main>



        <h1 class="text-center mt-4"><i><u>Catalogue Atelier</u></i></h1>

        <div class="row">
            <?php
            if (!empty($ateliers_cata)) {


                for ($i = 0; $i < count($ateliers_cata); $i++) :
            ?>
                    <div class="col-md-3 col-lg-3 col-sm-5 mt-3 ml-1 mb-3">
                        <div class="card border-success " style="max-width: 18rem;">
                            <div class="card-header font-weight-bold"><?php echo $ateliers_cata[$i]->getTitre(); ?></div>
                            <img class="card-img-top" src="../public/images/<?php echo $ateliers_cata[$i]->getId(); ?>-<?php echo $ateliers_cata[$i]->getImage(); ?>">
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
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endfor;
            } elseif (empty($ateliers_cata)) {
                ?>
                <h3 class="ml-5 mt-5 bg-light"><b>Aucune formation dans le catalogue pour le moment !</b></h3>


            <?php
            }
            ?>
        </div>

    </main>

    <?php
    $content = ob_get_clean();
    $titre = "Catalogue d'Atelier";
    require "template.view.php";
    ?>
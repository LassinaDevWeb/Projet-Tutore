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

                                <form method="POST" action="connexion" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="indentifiant">Indentifiant:</label>
                                        <input type="text" class="form-control input" id="identifiant" placeholder="Entrer votre identifiant" name="identifiant" style="text-align : center;">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mot de passe:</label>
                                        <input type="password" class="form-control input" id="password" placeholder="Enter votre mot de passe" name="password" style="text-align : center;">
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
                        <a href="public_prog" class="btn btn-link lien_nav  " class="Text"> Atelier programmés</a>
                    </div>

                    <div class="col-4 ">
                        <a href="public_catalogue" class="btn btn-link lien_nav  " class="Text"> catalogue d'Ateliers</a>
                    </div>

                    <div class="col-4 ">
                        <a href="#" class="btn btn-link lien_nav  " class="Text"> <b> Accueil </b></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>

        <div class="jumbotron mt-5 container col-sm-10 " id="jum">
            <h1 class="display-4">Bienvenue dans Déclic Pour Action!</h1>
            <p class="lead">Offrant la possiblité de s'inscrire à des ateliers programmées et de voir le catalogue d'atelier</p>
        </div>








    </main>

    <?php
    $content = ob_get_clean();
    $titre = "Accueil";
    require "template.view.php";
    ?>
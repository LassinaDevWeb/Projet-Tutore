<?php ob_start();

?>

<body class="body_public">
    <header>

        <nav class="navbar navbar-expand-lg " id="navbar">
            <div class="container-fluid">



                <h1 class="logo"><i>Déclic pour l'action</i></h1>

    </header>

    <main>

        <div class="jumbotron mt-5 container col-sm-10 " id="jum">
            <h1 class="display-4">Récuperation de compte</h1>

            <form method="POST" action="verif_data" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="indentifiant">Indentifiant:</label>
                    <input type="text" class="form-control input" id="identifiant" placeholder="Entrer votre identifiant" name="identifiant" style="text-align : center;">
                </div>
                <div class="form-group">
                    <label for="password">Email:</label>
                    <input type="email" class="form-control input" id="email" placeholder="Enter votre Email" name="email" style="text-align : center;">
                </div>

                <button type="submit" class="btn btn-dark">Verification</button>

            </form>

        </div>








    </main>

    <?php
    $content = ob_get_clean();
    $titre = "Mot de passe perdu";
    require "template.view.php";
    ?>
<?php
    session_start();
    if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
        header("location: index.php");
        exit();
    }
    elseif ($_SESSION['mode'] != "admin"){
        header("location: index.php");
        exit();
    }
?>
<html lang="fr"> <head> 
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script> 
    
    <title>Ajouter un enregistrement</title> 
    </head>
<main>
<div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-black" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <label class="fs-2">Ajouter un enregistrement</label>
                            <br/><br/>
                            <form ENCTYPE='multipart/form-data' action="upload.php" method="POST">
                            <div class="input-group mb-3">
                                <input class="input-group-text" type=text name=id placeholder=id>
                                <input class="input-group-text" type=text name=modele placeholder=modele>
                                <input class="input-group-text" type=text name=marque placeholder=marque>
                                <input class="input-group-text" type=text name=prix placeholder=prix>
                            </div>
                                <input type=file name=photo accept=".png" class="form-control">
                                <br>
                                <input type=submit value=Ajouter class="btn btn-primary">
                            </form>
                            <button onclick="window.location.href='backoffice.php';" class="btn text-bg-danger" >Retour</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
<footer class="blockquote-footer">
    <hr>
    <p>Ce site est un projet réalisé par OULAI Kevin et ROSALIE Thibault</p>
    <p>Dans le cadre de la ressource R3.01 : Développement web</p>
</footer>
</html>
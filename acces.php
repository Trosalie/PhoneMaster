<?php
    $mode = $_GET['mode'];
?>

<html lang="fr"> <head>
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script> 
    
    <title>Acces back-office</title> 
    </head>

    <body>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-black" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <?php
                            if($mode == "signin"){
                                print "<p class='text-success'>Compte crée avec succes !</p>";
                                $mode = "client";
                            }
                            if($mode == "admin"){
                                print "<form action=login.php?mode=admin method=post>";
                                print "<h1 class='fw-bold fs-4'>Se connecter en tant qu'administrateur</h1><br>";
                                }
                            else{
                                print "<form action=login.php?mode=client method=post>";
                                print "<h1 class='fw-bold fs-4'>Se connecter en tant que client</h1><br>";
                            }
                            ?>
                                <div class="mb-3">
                                    <label class="form-label">Nom d'utilisateur :</label>
                                    <input type="text" name="login" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mot de passe :</label>
                                    <input type="password" name="pwd" class="form-control">
                                    <br/><br/>
                                    <input type="submit" value="Connexion" class="btn btn-primary">
                                    <br>
                                    <?php
                                    if($mode == "admin") {
                                        print "<br><a href=index.php class=\"link-offset-2 link-underline link-underline-opacity-0\">Sortir du Back-Office</a>";
                                    }
                                    else{
                                        print "<br><a href=signin.php class=\"link-offset-2 link-underline link-underline-opacity-0\">Créer un compte</a>";
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
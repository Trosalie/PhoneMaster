<html lang="fr"> <head>
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>

    <title>Créer un compte</title>
</head>
<body>
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card text-black" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">



<form action=signin.php method=post>
    <div class="mb-3">
        <label class="form-label">Nom d'utilisateur :</label>
        <input type=text name=username class="form-control">
    </div>
    <br />
    <div class="mb-3">
        <label class="form-label">Mot de passe :</label>
        <input type=password name=password class="form-control"><br/>
        <input type=submit value=Valider class="btn btn-primary">
    </div>
</form>


<?php
    if(isset($_POST["username"]) and isset($_POST["password"])){
        if($_POST["username"] == "" or $_POST["password"] == ""){
            print "Veuillez renseigner tout les champs";
        }
        else{
            $usersJson = file_get_contents("usersclient.json");
            $users = json_decode($usersJson, true);
            $valid = true;
            foreach($users as $user => $pwd){
                if($_POST["username"] == $user){
                    $valid = false;
                }
            }
            if($valid){
                $users[$_POST["username"]] = password_hash($_POST["password"], PASSWORD_DEFAULT);
                json_encode($users);
                $updatedUsers = json_encode($users);
                file_put_contents('usersclient.json', $updatedUsers);
                print "<meta http-equiv=refresh content=0;URL='acces.php?mode=signin'>";
            }
            else{
                print "<p class='text-danger'>Nom d'utilisateur existant</p>";
            }
        }
    }
?>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
<footer class="blockquote-footer">
    <hr>
    <p>Ce site est un projet réalisé par OULAI Kevin et ROSALIE Thibault</p>
    <p>Dans le cadre de la ressource R3.01 : Développement web</p>
</footer>
</html>

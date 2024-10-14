<?php
    // On définit un login et un mot de passe de base
    $usersJson = file_get_contents("usersadmin.json");
    $users = json_decode($usersJson, true);

    // on teste si nos variables sont définies
    if (isset($_POST['login']) && isset($_POST['pwd'])) {
        // on vérifie les informations saisies
        foreach($users as $user => $hash_pwd) {
            if ($user == $_POST['login'] && password_verify($_POST['pwd'], $hash_pwd)) {
                session_start();
                // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['pwd'] = $_POST['pwd'];
                // on redirige notre visiteur vers une page de notre section membre
                header('Location: index.php');
            } else {
                // echo '<body onLoad="alert(\'Membre non reconnu...\')">';
                // puis on le redirige vers la page d'accueil
                echo '<meta http-equiv="refresh" content="0;URL=index.php">';
            }
        }
    }
    else {
        // echo 'Les variables du formulaire ne sont pas déclarées.';
        echo '<meta http-equiv="refresh" content="0;URL=loginClient.php">';
    }
<?php
    $mode = $_GET['mode'];
    $valid = false;

    $usersJson = file_get_contents("users".$mode.".json");
    $users = json_decode($usersJson, true);

    // on teste si nos variables sont définies
    if (isset($_POST['login']) && isset($_POST['pwd'])) {
        // on vérifie les informations saisies
        foreach($users as $user => $hash_pwd) {
            if ($user == $_POST['login'] and password_verify($_POST['pwd'], $hash_pwd)) {
                session_start();
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['pwd'] = $_POST['pwd'];

                if($mode == "admin") {
                    header('Location: backoffice.php');
                }
                else{
                    header('Location: index.php');
                }
                $valid = true;
            }
        }
        if(!$valid){
            echo "<meta http-equiv=refresh content=0;URL=acces.php?mode=$mode>";
        }
    }
    else {
        echo "<meta http-equiv=refresh content=0;URL=acces.php?mode=$mode>";
    }
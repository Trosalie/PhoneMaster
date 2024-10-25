<?php
    session_start();

    $id = "_". $_GET['id'];


    if(isset($_SESSION[$id])){
        if(isset($_POST['qte'])) {
            $qte = $_POST['qte'];
            $_SESSION[$id] -= $qte;
        }
        else{
            $_SESSION[$id]--;
        }
    }

echo "<meta http-equiv=refresh content=0;URL=panier.php>";
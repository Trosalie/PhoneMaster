<?php
    session_start();

    $id = "_". $_GET['id'];
    $qte = $_POST['qte'];

    if(isset($_SESSION[$id])){
        $_SESSION[$id]-=$qte;
    }

echo "<meta http-equiv=refresh content=0;URL=panier.php>";
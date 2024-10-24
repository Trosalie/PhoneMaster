<?php
    session_start();
    $id = "_". $_GET['id'];

    if(isset($_SESSION[$id])){
        $_SESSION[$id]--;
    }

echo "<meta http-equiv=refresh content=0;URL=panier.php>";
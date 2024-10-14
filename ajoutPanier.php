<?php
    session_start();
    $id = "_". $_GET['id'];

    if(isset($_SESSION[$id])){
        $_SESSION[$id]++;
    }
    else{
        $_SESSION[$id] = 1;
    }
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
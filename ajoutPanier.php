<?php
    session_start();
    if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
        header("location: index.php");
        exit();
    }
    elseif ($_SESSION['mode'] != "client"){
        header("location: index.php");
        exit();
    }
    
    $id = "_". $_GET['id'];

    if(isset($_SESSION[$id])){
        $_SESSION[$id]++;
    }
    else{
        $_SESSION[$id] = 1;
    }
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
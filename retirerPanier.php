<?php
    session_start();
    $id = "_". $_REQUEST['id'];

    if(isset($_SESSION[$id])){
        $_SESSION[$id]--;
    }
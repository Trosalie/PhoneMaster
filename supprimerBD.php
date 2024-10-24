<?php
    session_start();
    if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
        header("location: index.php");
        exit();
    }
    elseif ($_SESSION['mode'] != "admin"){
        header("location: index.php");
        exit();
    }

    $bdd = "koulai001_bd"; // Base de données 
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur 
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */ 
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");
    $id = $_GET['ID'];

    $dir = "images";
    $imagePath = $dir."/".$id.".png";
    unlink($imagePath);

    $query = $link->prepare("DELETE FROM `Telephone` WHERE `id` = (?)");
    $query->bind_param('i',$id);
    $query->execute();
    echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';


    $link -> close();

<?php
    session_start();
    if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
        header("location: acces.php");
        exit();
    }
    include_once("loadVignette.php");

    $bdd = "koulai001_bd"; // Base de données 
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur 
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */ 
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");


    $id = $_POST["id"];
    $modele = $_POST["marque"];
    $marque = $_POST["modele"];
    $prix = $_POST["prix"];


    $dir = "images";
    $name = $id.".png";
    $nameVign = $id . "_vignette.png";

    if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        unlink("$dir/$name");
        unlink("vignettes/$nameVign");
        move_uploaded_file($_FILES["photo"]["tmp_name"], "$dir/$name");
        // Génération de la vignette pour la photo upload
        $monImage = loadVignette("$dir/$name");
        imagepng($monImage, "vignettes/$nameVign");
        imagedestroy($monImage);

        $query = $link->prepare("UPDATE Telephone SET modele = (?), marque = (?), prix = (?), image = (?) WHERE id = (?)");
        $query->bind_param('ssdis', $modele, $marque, $prix, $id, $name);
    }
    else{
        $query = $link->prepare("UPDATE Telephone SET modele = (?), marque = (?), prix = (?) WHERE id = (?)");
        $query->bind_param('ssdi', $modele, $marque, $prix, $id);
    }

    $query->execute();



    $link -> close();
    echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';


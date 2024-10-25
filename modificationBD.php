<?php
// Verification de connexion et du mode de login
    session_start();
    if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
        header("location: index.php");
        exit();
    }
    elseif ($_SESSION['mode'] != "admin"){
        header("location: index.php");
        exit();
    }

    // Connexion à la BD
    $bdd = "koulai001_bd"; // Base de données 
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur 
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */ 
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");

    // Récupération des variables du formulaire
    $id = $_GET["id"];
    $modele = $_POST["modele"];
    $marque = $_POST["marque"];
    $prix = $_POST["prix"];

    $dir = "images";
    $name = $id.".png";

    // On regarde si une image à été uploadée
    if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        unlink("$dir/$name"); // On supprime l'ancienne image
        move_uploaded_file($_FILES["photo"]["tmp_name"], "$dir/$name"); // On enregistre la nouvelle image

        // Requete d'insertion parametrée
        $query = $link->prepare("UPDATE Telephone SET modele = (?), marque = (?), prix = (?), image = (?) WHERE id = (?)");
        $query->bind_param('ssdis', $modele, $marque, $prix, $id, $name);
    }
    else{
        // Requete d'insertion parametrée
        $query = $link->prepare("UPDATE Telephone SET modele = (?), marque = (?), prix = (?) WHERE id = (?)");
        $query->bind_param('ssdi', $modele, $marque, $prix, $id);
    }
    // On execute la requete
    $query->execute();



    $link -> close();
    echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';



<?php
    include_once("loadVignette.php");

    if($_POST["id"] != 0 && $_POST["marque"] != "" && $_POST["modele"] != "" && $_POST["prix"] != 0 && is_uploaded_file($_FILES["photo"]["tmp_name"])){
        $dir = "images"; // Nom du dossier contenant les photos

        $name = $_POST["id"] . ".png"; // Nom du fichier de photo


        $bdd = "koulai001_bd"; // Base de données
        $host = "lakartxela.iutbayonne.univ-pau.fr";
        $user = "koulai001_bd"; // Utilisateur
        $pass = "koulai001_bd"; // mp
        $nomtable = "Telephone"; /* Connection bdd */
        $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la base de données<br>");


        $query = "SELECT id FROM $nomtable";
        $resultat = mysqli_query($link, $query);
        $i = 1;


        $id = $_POST["id"];
        $modele = $_POST["modele"];
        $marque = $_POST["marque"];
        $prix = $_POST["prix"];

        while ($donnee = mysqli_fetch_assoc($resultat)) {
            $idBD = $donnee["id"];
            if ($id == $idBD) {
                echo '<body onLoad="alert(\'ID existant dans la base de données\')">';
                echo '<meta http-equiv="refresh" content="0;URL=ajoutBD.php">';
                $resultat->free_result();
                $link->close();
                exit();
            }
        }

        if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {
            move_uploaded_file($_FILES["photo"]["tmp_name"], "$dir/$name");
            print '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
        }


        if ($query = $link->prepare("INSERT INTO `Telephone` (id, modele, marque, prix, image) VALUE ((?),(?),(?),(?),(?))")) {
            $query->bind_param('issds', $_POST["id"], $_POST["modele"], $_POST["marque"], $_POST["prix"], $name);
            $query->execute();
            echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
        }

        // Génération de la vignette pour la photo upload
        $nameVign = $id . "_vignette.png";
        $monImage = loadVignette("$dir/$name");
        imagepng($monImage, $dir/$nameVign);
        imagedestroy($monImage);
    }
    else
    {
        print "PAS OK";
        echo '<body onLoad="alert(\'Veuillez remplir le formulaire en entier\')">';
        echo '<meta http-equiv="refresh" content="0;URL=ajoutBD.php">';
    }

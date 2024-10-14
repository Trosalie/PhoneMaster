<?php
    session_start();
    ?>
<html lang="fr"> <head>
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>

    <title>Ajout Panier</title>
</head>
<button class="btn-primary" onclick="window.location.href='index.php'">Sortir du panier</button>
 <?php
    $bdd = "koulai001_bd"; // Base de données
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");


    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);

    while($donnee = mysqli_fetch_assoc($resultat)) {
        $idBD = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix = $donnee["prix"];
        if(isset($_SESSION["_".$idBD])) {
            $qte = $_SESSION["_".$idBD];
            print "<div class=\"card text-bg-info mb-3\">
                                <div class=\"card-header\">
                                    $modele
                                </div>
                                <ul class=\"list-group list-group-flush\">
                                    <li class=\"list-group-item\"><img src='images/$idBD.png'></li>
                                    <li class=\"list-group-item\">$prix</li>
                                    <li class=\"list-group-item\">$qte</li>
                                </ul>
                            </div>";
        }
    }



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
    $total = 0;
    $nombreArticle = 0;

    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);

    while($donnee = mysqli_fetch_assoc($resultat)) {
        $idBD = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix = $donnee["prix"];
        if(isset($_SESSION["_".$idBD]) && $_SESSION["_".$idBD] > 0) {
            $qte = $_SESSION["_".$idBD];
            $total += $prix * $qte;
            $nombreArticle += $qte;
            print "<div class=\"card mb-3\">
                                <div class=\"card-header\">
                                    $modele
                                </div>
                                <ul class=\"list-group list-group-flush\">
                                    <li class=\"list-group-item\"><img src='images/$idBD.png'></li>
                                    <li class=\"list-group-item\">$prix</li>
                                    <li class=\"list-group-item\">$qte</li>
                                    <li class=\"list-group-item\"><button onclick=window.location.href='retirerPanier.php?id=$idBD'; class=\"btn btn-primary\">Retirer du panier</button></li>
                                </ul>
                            </div>";
        }
    }

    if ($total > 0){
        print "<p class=fs-4>Nombre d'article(s) : ". $nombreArticle ."<br> Total = ".$total."€</p>";
        print "<button onclick=window.location.href='paiement.php';>Payer</button>";
    }
    else{
        print "<p class=fs-4>Panier vide</p>";
    }
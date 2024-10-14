<?php
    session_start();
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier'] = [];
    }
?>

<html lang="fr"> <head>
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>

    <title>Back-office</title>
</head>

<?php
    $id = $_GET['id'];


    $bdd = "koulai001_bd"; // Base de données
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");

    $query = "SELECT * FROM $nomtable WHERE id = $id";
    $resultat = mysqli_query($link,$query);

    while($donnee = mysqli_fetch_assoc($resultat)){
        $id = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix = $donnee["prix"];
        print "<div class=\"card text-bg-info mb-3\">
                        <div class=\"card-header\">
                            $id
                        </div>
                        <ul class=\"list-group list-group-flush\">
                            <li class=\"list-group-item\"><img src='images/$id.png'></li>
                            <li class=\"list-group-item\">$modele</li>
                            <li class=\"list-group-item\">$marque</li>
                            <li class=\"list-group-item\">$prix</li>
                        </ul>
                    </div>";
    }
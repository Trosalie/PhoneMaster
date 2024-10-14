<html lang="fr"> <head>
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
    <title>PhoneMaster</title>
</head>



<body class="container">
<?php
    $bdd = "koulai001_bd"; // Base de données
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");

    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);
    print "<div id=zone_cartes class=\"row row-cols-3\">";
    while($donnee = mysqli_fetch_assoc($resultat)){
        $id = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix =  $donnee["prix"] . " €";
        print "
                <div class=\"card text-bg-info col mb-3\">
                        <div class=\"card-header\">
                            $modele
                        </div>
                        <ul class=\"list-group list-group-flush\">
                            <li class=\"list-group-item\"><img src='images/$id.png'></li>
                            <p class=\"\">$prix</p>
                        </ul>
                            <button class=\"btn text-bg-secondary\" onclick=\"window.location.href='panier.php?id=$id';\">Ajouter au panier</button>
                    </div>";

    }
    print "</div>";
?>
</body>

<?php
print "<head>
<meta charset=UTF-8>
<meta http-equiv=Expires content=\"Thu, 01 Jan 1970 00:00:00 GMT\">
<title>Disable Browser Caching</title>
</head>";
    $bdd = "koulai001_bd"; // Base de données 
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur 
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */ 
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");

    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);

    while($donnee = mysqli_fetch_assoc($resultat)){
        $id = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix = $donnee["prix"];
        print "$id | $modele |  $marque |  $prix<br><br>";
    }

    $resultat -> free_result();
    $link -> close();
    ?>

<main>       
    <div>
    <button onclick="window.location.href='modificationBD.php';" >Modifier la base de données</button>
    <button onclick="window.location.href='supprimerBD.php';" >Supprimer un enregistrement</button>
    </div>
</main>

<?php
    session_start();
    if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
        header("location: index.php");
        exit();
    }
    print "<head> <title>Supprimer un enregistrement</title> </head>";
    $bdd = "koulai001_bd"; // Base de données 
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur 
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */ 
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");
    $i = 1;

    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);

    while($donnee = mysqli_fetch_assoc($resultat)){
        $id = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix = $donnee["prix"];
        print "<form action=supprimerBD.php method=post><input type=text name=idBD$i value=$id readonly=readonly> | $modele |  $marque |  $prix | <input type=checkbox name=button$i value=$id>Supprimer</input><br><br>";
        $i++;
    }

    print "<input type=submit value=\"Supprimer la selection\"></form>";

    for($ligne = 1; $ligne <= $i; $ligne++){
        if(isset($_POST["button".$ligne])){
            $query = $link->prepare("DELETE FROM `Telephone` WHERE `id` = (?)");
            $query->bind_param('i',$_POST["idBD".$ligne]);
            $query->execute();
            echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
        }
    }

    $resultat -> free_result();
    $link -> close();
?>


<main>       
    <div>
    <button onclick="window.location.href='backoffice.php';" >Retour</button>
    </div>
</main>

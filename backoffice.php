<?php
    $bdd = "koulai001_bd"; // Base de données 
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur 
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */ 
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");

    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);
    $i = 0;

    while($donnee = mysqli_fetch_assoc($resultat)){
        $id = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix = $donnee["prix"];
        print "<form action=backoffice.php method=post>Id <input type=text name=id$i value=$id disabled> Modele <input type=text name=modele$i value=\"$modele\"> | Marque <input type=text name=marque$i value=$marque> | Prix <input type=text name=prix$i value=$prix> €<br><br>";
        $i++;
    }
    print "<input type=submit value=\"Valider les changements\"></form>";

    if(isset($_POST["modele1"]) and isset($_POST["marque1"]) and isset($_POST["prix1"])){
        for($indice = 1; $indice <= $i; $indice++){
            print $indice;
            //$query = "UPDATE Telephone SET 'modele' = $_POST["modele$i"], 'marque' = $_POST["marque$i"], 'prix' = $_POST["prix$i"] WHERE 'id' = $_POST["id$i"]";
        }
    }

    $resultat -> free_result();
    $link -> close();
?>
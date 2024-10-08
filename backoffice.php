<?php
    $bdd = "koulai001_bd"; // Base de données 
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur 
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */ 
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");

    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);
    $i = 1;

    

    while($donnee = mysqli_fetch_assoc($resultat)){
        $id = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix = $donnee["prix"];
        print "<form action=backoffice.php method=post>Id <input type=text name=id$i value=$id disabled> Modele <input type=text name=modele$i value=\"$modele\"> | Marque <input type=text name=marque$i value=$marque> | Prix <input type=text name=prix$i value=$prix> €<br><br>";
        $i++;
    }
    print "<input type=submit value=\"Valider les changements\"></form>";
    $resultat -> free_result();
    
    //$resultatUp = mysqli_query($link,$query);

    //if(isset($_POST["modele0"]) and isset($_POST["marque0"]) and isset($_POST["prix0"])){
        for($indice = 1; $indice < $i; $indice++){
            //$id = $indice + 1;
            $modele = "modele".$indice;
            $marque = "marque".$indice;
            $prix = "prix".$indice;
            $values = [$_POST[$modele], $_POST[$marque], $_POST[$prix], $indice];
            $query = $link->prepare("UPDATE Telephone SET modele = (?), marque = (?), prix = (?) WHERE id = (?)");
            $query->bind_param('ssdi', $_POST[$modele], $_POST[$marque], $_POST[$prix], $indice);
            $query->execute();
            // $query = "UPDATE Telephone SET ". "modele = $_POST[$modele], marque = $_POST[$marque], prix = $_POST[$prix] WHERE id = $_POST[$id]";
            // if ($link->query($query) === TRUE) { 
            //     echo "Enregistrement mis à jour avec succès"; 
            // } else { 
            //     echo "Erreur lors de la mise à jour de l'enregistrement : " . $link->error; 
            // }
        }
    //}
    

    
    $link -> close();
?>
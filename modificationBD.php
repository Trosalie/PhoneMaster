<?php
session_start();
if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
    header("location: index.php");
    exit();
}
?>

<html> <head> 
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src='node_modules\bootstrap\dist\js\bootstrap.bundle.js'></script> 
    
    <title>Modification de la BD</title> 
    </head>

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
        print "<form action=modificationBD.php method=post>Id <input type=text name=id$i value=$id readonly=readonly> Modele <input type=text name=modele$i value=\"$modele\"> | Marque <input type=text name=marque$i value=$marque> | Prix <input type=text name=prix$i value=$prix> €<br><br>";
        $i++;
    }
    print "<input type=submit value=\"Valider les changements\"></form>";
    $resultat -> free_result();
    
    //$resultatUp = mysqli_query($link,$query);

    if(isset($_POST["modele1"])){
        for($indice = 1; $indice < $i; $indice++){
            $id = "id".$indice;
            $modele = "modele".$indice;
            $marque = "marque".$indice;
            $prix = "prix".$indice;
            $query = $link->prepare("UPDATE Telephone SET modele = (?), marque = (?), prix = (?) WHERE id = (?)");
            $query->bind_param('ssdi', $_POST[$modele], $_POST[$marque], $_POST[$prix], $_POST[$id]);
            $query->execute();
            echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
        }
    }
    
    $link -> close();
?>
<button onclick="window.location.href='backoffice.php';" >Retour</button>
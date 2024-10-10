<?php
session_start();
if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
    header("location: index.php");
    exit();
}
?>

<html> <head> 
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script> 
    
    <title>Back-office</title>
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
        <button onclick="window.location.href='ajoutBD.php';" >Ajouter un enregistrement</button>
        <button onclick="window.location.href='modificationBD.php';" >Modifier la base de données</button>
        <button onclick="window.location.href='supprimerBD.php';" >Supprimer un enregistrement</button>
    </div>
    <button onclick="window.location.href='logout.php';" >Se déconnecter</button>
</main>

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
<main>   
<div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-black" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
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
        print "<div class=\"card text-bg-info mb-3\">
                    <div class=\"card-header\">
                        $modele
                    </div>
                    <ul class=\"list-group list-group-flush\">
                        <li class=\"list-group-item\">$id</li>
                        <li class=\"list-group-item\">$marque</li>
                        <li class=\"list-group-item\">$prix</li>
                    </ul>
                </div>";
    }

    $resultat -> free_result();
    $link -> close();
    ?>
 
                            <div>
                                <p>
                                <p>
                                <button onclick="window.location.href='ajoutBD.php';"  class="btn btn-primary">Ajouter un enregistrement</button>
                                <p>
                                <button onclick="window.location.href='modificationBD.php';" class="btn btn-primary">Modifier la base de données</button>
                                <p>
                                <button onclick="window.location.href='supprimerBD.php';" class="btn btn-primary">Supprimer un enregistrement</button>
                                <p>
                            </div>
                            <button onclick="window.location.href='logout.php';" class="btn text-bg-secondary">Se déconnecter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>

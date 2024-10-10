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
    
    <title>Supprimer un enregistrement</title> 
    </head>
    <div class="container py-5 h-200">
            <div class="row d-flex justify-content-center align-items-center h-200">
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
    $i = 1;

    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);

    while($donnee = mysqli_fetch_assoc($resultat)){
        $id = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix = $donnee["prix"];
        print "<form action=supprimerBD.php method=post>
        <div class=\"card text-bg-info mb-3\">
            <div class=\"card-header\">
                        $modele
            </div>
            <ul class=\"list-group list-group-flush\">
                            <li class=\"list-group-item\"><input type=text name=idBD$i value=$id class=\"input-group-text\" readonly=readonly></li>
                            <li class=\"list-group-item\">$marque</li>
                            <li class=\"list-group-item\">$prix</li>
                            <li class=\"list-group-item\"><input type=checkbox name=button$i value=$id class=\"form-check-input\"> Supprimer</input></li>
            </ul>
            
        </div>";
        $i++;
    }

    print "<input type=submit value=\"Supprimer la selection\" class=\"btn btn-primary\"></form>";
?>
    <div>
    <button onclick="window.location.href='backoffice.php';" class="btn text-bg-danger">Retour</button>
    </div>
<?php
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
</div>
                    </div>
                </div>
            </div>
        </div>

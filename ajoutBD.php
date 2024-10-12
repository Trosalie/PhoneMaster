<?php
    session_start();
    if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
        header("location: acces.php");
        exit();
    }
?>
<html> <head> 
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script> 
    
    <title>Ajouter un enregistrement</title> 
    </head>
<main>
<div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-black" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <label class="fs-2">Ajouter un enregistrement</label>
                            <br/><br/>
                            <form action="ajoutBD.php" method="POST">
                            <div class="input-group mb-3">
                                <input class="input-group-text" type=text name=id placeholder=id>
                                <input class="input-group-text" type=text name=modele placeholder=modele>
                                <input class="input-group-text" type=text name=marque placeholder=marque>
                                <input class="input-group-text" type=text name=prix placeholder=prix>
                            </div>
                                <input type=submit value=Ajouter class="btn btn-primary">
                            </form>
                            <button onclick="window.location.href='backoffice.php';" class="btn text-bg-danger" >Retour</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    $bdd = "koulai001_bd"; // Base de données 
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur 
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */ 
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");

    $query = "SELECT id FROM $nomtable";
    $resultat = mysqli_query($link,$query);
    $i = 1;

    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $modele = $_POST["modele"];
        $marque = $_POST["marque"];
        $prix = $_POST["prix"];

        while($donnee = mysqli_fetch_assoc($resultat)){
            $idBD = $donnee["id"];
            if($id == $idBD){
                echo '<body onLoad="alert(\'ID existant dans la base de données\')">';
                $resultat -> free_result();
                $link -> close();
                exit();
            }
        }

        if($query = $link->prepare("INSERT INTO `Telephone` (id, modele, marque, prix) VALUE ((?),(?),(?),(?))"))
        {
            $query->bind_param('issd',$_POST["id"],$_POST["modele"],$_POST["marque"],$_POST["prix"]);
            $query->execute();
            echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
        }

    }
    $resultat -> free_result();
    $link -> close();
?>

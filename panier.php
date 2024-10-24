<?php
    session_start();
    if(!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
        header("location: index.php");
        exit();
    }
    elseif ($_SESSION['mode'] != "client"){
        header("location: backoffice.php");
        exit();
    }
    ?>
<html lang="fr"> <head>
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>

    <title>Ajout Panier</title>
</head>
<nav class="btn-toolbar justify-content-between" role="toolbar">
    <p></p>
    <button class="btn btn-secondary" onclick="window.location.href='index.php'">Sortir du panier</button>
</nav>
<hr>
<br>
<h1 class="fs-1 text-center fw-bolder">Votre panier</h1>
<br>
<hr>
<table id="matable" class="table table-striped table-hover">
    <thead>
    <tr>
        <th class="">Image</th>
        <th>Modele</th>
        <th>Marque</th>
        <th>Prix</th>
        <th>Quantite</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
 <?php
    $bdd = "koulai001_bd"; // Base de données
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");
    $total = 0;
    $nombreArticle = 0;

    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);

    while($donnee = mysqli_fetch_assoc($resultat)) {
        $idBD = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix = $donnee["prix"];

        if(isset($_SESSION["_".$idBD]) && $_SESSION["_".$idBD] > 0) {
            $qte = $_SESSION["_".$idBD];
            $total += $prix * $qte;
            $nombreArticle += $qte;
            print "<tr>
                        <td><img class=img-thumbnail src='images/$idBD.png'></td>
                        <td>$modele</td>
                        <td>$marque</td>
                        <td>$prix</td>
                        <td>$qte</td>
                        <!--    <td><button onclick=window.location.href='retirerPanier.php?id=$idBD' class=\"btn btn-primary\">Retirer du panier</button></td>-->
                        <td><button class=\"btn btn-primary\" data-bs-toggle='modal' data-bs-target='#fRetirer_$idBD'>Retirer du panier</button></td>
                        
                        <div class='modal fade' id='fRetirer_$idBD' tabindex='-1' aria-labelledby='Retirer' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-5' id='fRetirerLabel_$idBD'>Retirer du panier</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Annuler'></button>
                                </div>
                                <div class='modal-body'>
                                    <form action=retirerPanier.php?id=$idBD method=POST>
                                        <img src='images/$idBD.png'><hr>
                                        Nombre de <b>$modele</b> à retirer :
                                        <input type='number' name='qte' min='1' max='$qte' value=1><br>
                                        <input type='submit' class='btn btn-success' value=Retirer>
                                    </form>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Annuler</button>

                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </tr>";
        }
    }
?>
    </tbody>
</table>
    <?php
    if ($total > 0){
        print "<p class=fs-4>Nombre d'article(s) : ". $nombreArticle ."<br> Total = ".$total."€</p>";
        print "<button class='btn text-bg-success position-absolute start-50 translate-middle' onclick=window.location.href='paiement.php';>Payer</button>";
    }
    else{
        print "<p class=fs-4>Panier vide</p>";
    }
    ?>

<footer class="blockquote-footer">
    <hr>
    <p>Ce site est un projet réalisé par OULAI Kevin et ROSALIE Thibault</p>
    <p>Dans le cadre de la ressource R3.01 : Développement web</p>
</footer>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="node_modules/datatables.net/js/dataTables.js"></script>
<script src="node_modules/datatables.net-bs5/js/dataTables.bootstrap5.js"></script>
<script src="JS/script.js"></script>
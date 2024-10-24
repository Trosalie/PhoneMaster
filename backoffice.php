<?php
session_start();
if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
    header("location: index.php");
    exit();
}
elseif ($_SESSION['mode'] != "admin"){
    header("location: index.php");
    exit();
}
?>

<html lang="fr"> <head>
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Back-office</title>
</head>

<nav class="btn-toolbar justify-content-between" role="toolbar">
    <p></p>
    <button onclick="window.location.href='logout.php';" class="btn text-bg-secondary">Se déconnecter</button>
</nav>
<main>
    <table id="matable" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Modele</th>
            <th>Marque</th>
            <th>Prix</th>
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

    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);

    while($donnee = mysqli_fetch_assoc($resultat)){
        $id = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix = $donnee["prix"];
        print "
                    <tr>
                        <td>$id</td>
                        <td><img class=img-thumbnail src='loadVignette.php?id=$id'></td>
                        <td>$modele</td>
                        <td>$marque</td>
                        <td>$prix</td>
                        <td>
                            <button class=\"btn btn-primary\" data-bs-toggle='modal' data-bs-target='#fModifier_$id'>Modifier</button>
                            <button class=\"btn btn-primary\" data-bs-toggle='modal' data-bs-target='#fSupprimer_$id'>Supprimer</button>
                        </td>
                    
                    <!-- Fenetre modale modification -->
                    <div class='modal fade' id='fModifier_$id' tabindex='-1' aria-labelledby='Modifier' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-5' id='fModifierLabel_$id'>Modifier</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Annuler'></button>
                                </div>
                                <div class='modal-body'>
                                    <form ENCTYPE='multipart/form-data' action=modificationBD.php?id=$id method=POST>
                                        <img src='images/$id.png'><hr>
                                        Modele : <input type=text name=modele value='$modele' class=form-control><br>
                                        Marque : <input type=text name=marque value='$marque' class=form-control><br>
                                        Prix : <input type=text name=prix value='$prix' class=form-control><br>
                                        Changer la photo<input type=file name=photo accept=.png class=form-control><br>
                                        <button type='submit' class='btn btn-success' value=''><i class=\"bi bi-floppy-fill\"></i></button>
                                    </form>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Annuler</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    </tr>

                    
                    <!-- Fenetre modale suppression -->
                    <div class='modal fade' id='fSupprimer_$id' tabindex='-1' aria-labelledby='Supprimer' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-5' id='fSupprimerLabel_$id'>Supprimer</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Annuler'></button>
                                </div>
                                <div class='modal-body'>
                                    <img src='images/$id.png'><hr>
                                    Prix : $prix<br>
                                    Modele : $modele<br>
                                    Marque : $marque<br>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Annuler</button>
                                    <button onclick=\"window.location.href='supprimerBD.php?ID=$id';\" class='btn text-bg-danger'><i class='bi bi-trash-fill'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </tr>
                ";
    }

    $resultat -> free_result();
    $link -> close();
    ?>
        </tbody>
    </table>
    <button class="btn btn-primary position-absolute start-50 translate-middle" onclick="window.location.href='ajoutBD.php'">Ajouter un enregistrement</button>
</main>
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
</html>
<?php
    session_start();
    $connected = false;

    if (isset($_SESSION['login']) || isset($_SESSION['pwd'])) {
        $connected = true;
    }
?>

<html lang="fr"> <head>
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
    <title>PhoneMaster</title>
</head>

<body class="container">
<?php
    include_once 'loadVignette.php';
    if (!is_dir("vignettes")) {
        mkdir("vignettes");
    }

    $images = scandir("images");

    foreach ($images as $image) {
        if (!in_array($image, [".", ".."])) {

            $monImage = loadVignette("images/$image");
            imagepng($monImage, "vignettes/$image");
            imagedestroy($monImage);
        }
    }

    $bdd = "koulai001_bd"; // Base de données
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "koulai001_bd"; // Utilisateur
    $pass = "koulai001_bd"; // mp
    $nomtable = "Telephone"; /* Connection bdd */
    $link = mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données<br>");
?>
    <nav class="btn-toolbar justify-content-between" role="toolbar">
    <?php
    if (!$connected){
        print "
        <button class=\"btn text-bg-secondary\" onclick=window.location.href='acces.php?mode=client'>Se connecter</button>
        <a class='text-decoration-none' href='acces.php?mode=admin'>Acceder au back-office</a>
        </nav>";
    }
    else{
        print "<button class=\"btn text-bg-secondary\" onclick=window.location.href='panier.php'>Acceder au panier</button>
                <button class=\"btn text-bg-secondary\" onclick=window.location.href='logout.php'>Se déconnecter</button>
                
                </nav>
                <h1 class=\"fs-1 text-center fw-bolder\"> Bonjour ". $_SESSION['login'] ." ! </h1>";
    }

    $query = "SELECT * FROM $nomtable";
    $resultat = mysqli_query($link,$query);
    print "<div id=zone_cartes class=\"row row-cols-3\">";
    while($donnee = mysqli_fetch_assoc($resultat)){
        $id = $donnee["id"];
        $modele = $donnee["modele"];
        $marque = $donnee["marque"];
        $prix =  $donnee["prix"] . " €";
        print "<!-- Telephone $id -->
                <div class='card col' style='width: 18rem;'>
                    <img src='vignettes/$id" . "_vignette.png' class='card-img-top' alt='. . .'>
                    <div class='card-body'>
                        <h5 class='card-title'>$modele</h5>
                        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#fenetre_$id'>
                            Informations
                        </button>
                    </div>
                </div>

                <!-- Fenetre modale attachée au téléphone $id -->
                    <div class='modal fade' id='fenetre_$id' tabindex='-1' aria-labelledby='fenetreLabel_$id' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-5' id='fenetreLabel_$id'>$modele</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <img src='images/$id.png'><hr>
                                    Prix : $prix<br>
                                    Modele : $modele<br>
                                    Marque : $marque<br>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Fermer</button>
                                ";
        if($connected){
        print"              <button class=\"btn text-bg-secondary\" onclick=\"window.location.href='ajoutPanier.php?id=$id';\">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
            </div>";
        }
        else{
            print"                  <button class=\"btn text-bg-secondary\" onclick=\"window.location.href='#';\">🔒</button>
                                </div>
                            </div>
                        </div>
                    </div>";
        }
    }
    print "</div>";
?>
</body>
<footer class="blockquote-footer">
    <hr>
    <p>Ce site est un projet réalisé par OULAI Kevin et ROSALIE Thibault</p>
    <p>Dans le cadre de la ressource R3.01 : Développement web</p>
</footer>
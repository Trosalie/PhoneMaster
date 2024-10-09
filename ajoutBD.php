<?php
    session_start();
    if (!isset($_SESSION['login']) || !isset($_SESSION['pwd'])){
        header("location: index.php");
        exit();
    }
?>

<main>
    <form action="ajoutBD.php" method="POST">
        <input type=text name=id placeholder=id>
        <input type=text name=modele placeholder=modele>
        <input type=text name=marque placeholder=marque>
        <input type=text name=prix placeholder=prix>
        <input type=submit value=Ajouter>
    </form>
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
                print "Identifiant NON valide !";
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
<main>       
    <div>
    <button onclick="window.location.href='backoffice.php';" >Retour</button>
    </div>
</main>

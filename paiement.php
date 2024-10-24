<html lang="fr"> <head>
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
    <title>Formulaire de paiement</title>
</head>

<section class="gradient-custom">
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-7 col-lg-5 col-xl-4">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <form action="paiement.php" method="post">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div data-mdb-input-init class="form-outline">
                                    <input class="form-control form-control-lg" id="typeNom" type="text" placeholder="Nom"/>
                                    <label class="form-label" for="typeNom">Nom</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-between align-items-center mb-3 col">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="text" pattern="[^a-zA-Z]+" id="typeText" name="numeroCarte" class="form-control form-control-lg" size="17"
                                               placeholder="1234567890123457" minlength="16" maxlength="16"/>
                                        <label class="form-label" for="typeText">Numéro de carte</label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end pb-4 ms-5 col">
                                        <h1> <i class="bi bi-credit-card"></i></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-between align-items-center pb-2 col">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="date" id="typeExp" name="dateExp" class="form-control form-control-lg"/>
                                        <label class="form-label" for="typeExp">Expiration</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pb-2 col">
                                    <div data-mdb-input-init class="form-outline">
                                        <input class="form-control form-control-lg" id="typeCVV" type="password" placeholder="***">
                                        <label class="form-label" for="typeCVV">CVV/CVC</label>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Valider le paiement" class="btn btn-primary">



                            <?php
                                if(isset($_POST["numeroCarte"]) and isset($_POST["dateExp"])){
                                    $fin = substr($_POST["numeroCarte"], -1);
                                    $debut = substr($_POST["numeroCarte"], 0, 1);

                                    $jour = New DateTime('now');
                                    $jour->modify('+3 month');
                                    $jour = $jour->format("y-m-d");

                                    $dateExp= $_POST["dateExp"];

                                    if($fin != $debut){
                                        print "<p class='text-danger'>Numéro de carte érroné</p>";
                                    }
                                    else{
                                        if(strtotime($dateExp) < strtotime($jour)) {
                                            print "<p class='text-danger'>Date d'expiration invalide</p>";
                                        }
                                        else{
                                            print "<p class='text-success'>Paiement valide</p>";
                                        }
                                    }
                                }

                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

<button class="btn btn-secondary position-absolute start-50 translate-middle" onclick="window.location.href='panier.php'">Retour</button>
<br>

<footer class="blockquote-footer">
    <hr>
    <p>Ce site est un projet réalisé par OULAI Kevin et ROSALIE Thibault</p>
    <p>Dans le cadre de la ressource R3.01 : Développement web</p>
</footer>

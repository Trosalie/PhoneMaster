<html> <head> 
    <link rel='stylesheet' type='text/css' href='node_modules\bootstrap\dist\css\bootstrap.css'>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script> 
    
    <title>Acces back-office</title> 
    </head>

    <body class="container mt-10">
        <form action="login.php" method="post">
            <div class="mx-55">
                <label class="form-label">Nom d'utilisateur :</label>
                <input type="text" name="login" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe :</label>
                <input type="password" name="pwd" class="form-control">
                <input type="submit" value="Connexion" class="btn btn-primary">
            </div>
        </form>
    </body>
</html>
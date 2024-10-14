<?php
// On démarre la session
session_start ();
// On détruit les variables de notre session
unset($_SESSION['panier']);
// On redirige le visiteur vers la page d'accueil
header ('location: index.php');
exit();
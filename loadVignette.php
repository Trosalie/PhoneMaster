<?php
    // Je récupère la taille de l'image et je la diminue de moitié pour la nouvelle image
    $id = $_GET['id'];
    $path = "images/$id.png";
    list($largeur, $hauteur) = getimagesize($path);
//    $newHauteur = round($hauteur * 0.4);
//$newLargeur = round($largeur * 0.4);/
    $newHauteur = 130;
    $newLargeur = 110;
    $imagePHP = ImageCreateTrueColor($newLargeur, $newHauteur); // Vignette
    $image = ImageCreateFromPng($path); // Photo du phone

    // Je recopie la photo dans la vignette
    imagecopyresampled($imagePHP, $image, 0, 0, 0, 0, $newLargeur, $newHauteur, $largeur, $hauteur);
    imagejpeg($imagePHP);
    imagedestroy($imagePHP);

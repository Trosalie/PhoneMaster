<?php
    function loadVignette($fichier) {
        // Je récupère la taille de l'image et je la diminue de moitié pour la nouvelle image
        list($largeur, $hauteur) = getimagesize($fichier);
        $newHauteur = round($hauteur * 0.4);
        $newLargeur = round($largeur * 0.4);
        $imagePHP = ImageCreateTrueColor($newLargeur, $newHauteur); // Vignette
        $image = ImageCreateFromPng($fichier); // Photo du phone
        
        // Je recopie la photo dans la vignette
        imagecopyresampled($imagePHP, $image, 0, 0, 0, 0, $newLargeur, $newHauteur, $largeur, $hauteur);
        return $imagePHP;
    }
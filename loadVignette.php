<?php
    function loadVignette($fichier) {
        // Je récupère la taille de l'image et je la diminue de moitié pour la nouvelle image
        list($largeur, $hauteur) = getimagesize($fichier);
        $imagePHP = ImageCreateTrueColor($largeur * 0.1, $hauteur * 0.1); // Vignette
        $image = ImageCreateFromPng($fichier); // Photo du phone
        
        // Je recopie la photo dans la vignette
        imagecopyresampled($imagePHP, $image, 0, 0, 0, 0, $largeur * 0.1, $hauteur * 0.1, $largeur, $hauteur);
        return $imagePHP;
    }
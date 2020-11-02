<?php
    include_once '../model/produits.php';

    $leProduit = new Produits();
    $leProduit->retrieveByCodeBarre($_REQUEST['code']);

    echo $leProduit->get_leIngredient()->get_laSousCategorie()->get_laCategorie()->get_nom();
    echo $leProduit->get_leIngredient()->get_laSousCategorie()->get_nom();
    echo $leProduit->get_leIngredient()->get_nom();
    echo $leProduit->get_laMarque()->get_nom();
    echo $leProduit->get_lePays()->get_nom();
    echo $leProduit->get_leTypeConditionnement()->get_nom();
    echo $leProduit->get_quantiteConditionnement();
    echo $leProduit->get_laUnite()->get_nom();

    /*
        Risque changer, si résolution du problème "Code-Barre".
    */
?>
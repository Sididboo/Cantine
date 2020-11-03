<?php
    include_once '../model/produits.php';

    $leProduit = new Produits();
    $leProduit->retrieveByCodeBarre($_REQUEST['code']);

    $dataProduit = '<option value="'.$leProduit->get_leIngredient()->get_laSousCategorie()->get_laCategorie()->get_id().'" disabled>'.$leProduit->get_leIngredient()->get_laSousCategorie()->get_laCategorie()->get_nom().'</option>;';
    $dataProduit .= $leProduit->get_leIngredient()->get_laSousCategorie()->get_nom();
    $dataProduit .= $leProduit->get_leIngredient()->get_nom();
    $dataProduit .= $leProduit->get_laMarque()->get_nom();
    $dataProduit .= $leProduit->get_lePays()->get_nom();
    $dataProduit .= $leProduit->get_leTypeConditionnement()->get_nom();
    $dataProduit .= $leProduit->get_quantiteConditionnement();
    $dataProduit .= $leProduit->get_laUnite()->get_nom();

    echo $dataProduit;
?>
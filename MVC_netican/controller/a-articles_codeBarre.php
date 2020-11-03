<?php
    include_once '../model/produits.php';

    $leProduit = new Produits();
    $leProduit->retrieveByCodeBarre($_REQUEST['code']);

    $dataProduit = '<option value="'.$leProduit->get_leIngredient()->get_laSousCategorie()->get_laCategorie()->get_id().'" selected>'.$leProduit->get_leIngredient()->get_laSousCategorie()->get_laCategorie()->get_nom().'</option>;';
    $dataProduit .= '<option value="'.$leProduit->get_leIngredient()->get_laSousCategorie()->get_id().'" selected>'.$leProduit->get_leIngredient()->get_laSousCategorie()->get_nom().'</option>;';
    $dataProduit .= '<option value="'.$leProduit->get_leIngredient()->get_id().'" selected>'.$leProduit->get_leIngredient()->get_nom().'</option>;';
    $dataProduit .= '<option value="'.$leProduit->get_laMarque()->get_id().'" selected>'.$leProduit->get_laMarque()->get_nom().'</option>;';
    $dataProduit .= '<option value="'.$leProduit->get_lePays()->get_id().'" selected>'.$leProduit->get_lePays()->get_nom().'</option>;';
    $dataProduit .= '<option value="'.$leProduit->get_leTypeConditionnement()->get_id().'" selected>'.$leProduit->get_leTypeConditionnement()->get_nom().'</option>;';
    $dataProduit .= $leProduit->get_quantiteConditionnement().';';
    $dataProduit .= '<option value="'.$leProduit->get_laUnite()->get_id().'" selected>'.$leProduit->get_laUnite()->get_nom().'</option>';

    if (!empty($leProduit->get_id())) 
    {
        $dataProduit .= ';1';
    }

    echo $dataProduit;
?>
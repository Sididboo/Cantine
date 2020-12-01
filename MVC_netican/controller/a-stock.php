<?php 
session_start();

include './server/session.php';

include_once 'model/produitsAchetes.php';
include_once 'model/produits.php';

// liste des produits achetes
$listProduitsAchetes = array();

    $produitsAchetes = new produitsAchetes();
    $listProduitsAchetes = $produitsAchetes->findAll();

// liste des produits
$listProduits = array();

    $produits = new produits();
    $listProduits = $produits->findAll();


$etat = 'stock';

?>


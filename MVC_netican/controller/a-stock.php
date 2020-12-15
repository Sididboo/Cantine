<?php 

include_once 'model/produitsAchetes.php';
include_once 'model/produits.php';

// liste des produits achetes
$listProduitsAchetes = array();

    $produitsAchetes = new produitsAchetes();
    $listProduitsAchetes = $produitsAchetes->findAll();


$etat = 'stock';

?>


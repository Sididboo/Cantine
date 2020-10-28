<?php
    include_once '../model/produits.php';

    $leProduit = new Produits();
    $leProduit->retrieveByCodeBarre($_REQUEST['code']);

    echo $leProduit->get_id();
?>
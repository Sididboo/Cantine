<?php
    session_start();

    include_once '../model/tickets.php';
    include_once '../model/marques.php';
    include_once '../model/pays.php';
    include_once '../model/unites.php';
    include_once '../model/ingredients.php';
    include_once '../model/typesConditionnements.php';
    include_once '../model/produitsAchetes.php';
    include_once '../model/produits.php';

    $leTicket = new Tickets();
    $leTicket->retrieve($_SESSION['idTicket']);

    $leProduitAchete = new ProduitsAchetes("", $leTicket, );
    $leProduit = new Produits();
?>
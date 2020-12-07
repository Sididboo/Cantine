<?php
    // On inclut les classes :
    include_once 'model/categoriesTickets.php';
    include_once 'model/commerces.php';
    include_once 'model/tickets.php';

    // liste catégories tickets
    $listCategoriesTickets = array();
    // liste commerces
    $listCommerces = array();
    // liste tickets
    $listTickets = array();

    // On récupère les listes avec findAll()
    $categoriesTickets = new CategoriesTickets();
    $listCategoriesTickets = $categoriesTickets->findAll();

    $commerces = new Commerces();
    $listCommerces = $commerces->findAll();

    $tickets = new Tickets();
    $listTickets = $tickets->findAll();

    $etat = 'tickets';
?>
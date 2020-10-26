<?php
    session_start();

    include './server/session.php';

    include_once 'model/categoriesTickets.php';
    include_once 'model/commerces.php';
    include_once 'model/tickets.php';

    // liste catégories tickets
    $listCategoriesTickets = array();
    // liste commerces
    $listCommerces = array();
    // liste tickets
    $listTickets = array();

    $categoriesTickets = new CategoriesTickets();
    $listCategoriesTickets = $categoriesTickets->findAll();

    $commerces = new Commerces();
    $listCommerces = $commerces->findAll();

    $tickets = new Tickets();
    $listTickets = $tickets->findAll();

    $etat;

    if (isLogged())
    {
        $etat = 'tickets';
    }
        else
        {
            $etat = 'init';
        }
?>
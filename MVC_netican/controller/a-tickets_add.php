<?php
    include_once '../model/tickets.php';
    include_once '../model/categoriesTickets.php';
    include_once '../model/commerces.php';

    $date = $_REQUEST['date'];

    $laCategorie = new CategoriesTickets();
    $laCategorie->retrieve($_REQUEST['categorie']);

    $leCommerce = new Commerces();
    $leCommerce->retrieve($_REQUEST['commerce']);
    
    $file = $_REQUEST['file'];

    $leTicket = new Tickets('', $laCategorie, $leCommerce, $date, $file);
    $leTicket->create();

    $listTickets = array();
    $listTickets = $leTicket->findAll();

    for ($i=0; $i < count($listTickets); $i++) 
    { 
        echo '<tr>';
            echo '<td>'.$listTickets[$i]->get_dateTicket().'</td>';
            echo '<td>'.$listTickets[$i]->get_leCommerce()->get_nom().'</td>';
            echo '<td>'.$listTickets[$i]->get_laCategorie()->get_nom().'</td>';
            echo '<td>'.$listTickets[$i]->get_pieceJointe().'</td>';
            echo '<td>';
                echo '<button class="btn btn-primary" onclick="deleteTicket('.$listTickets[$i]->get_id().', '.$listTickets[$i]->get_pieceJointe().')"><i class="fas fa-trash"></i> Supprimer</button>';
                echo '<a href="./index.php?action=articles&idTicket='.$listTickets[$i]->get_id().'"><button class="btn btn-secondary"><i class="fas fa-plus"></i> Ajouter articles</button></a>';
            echo '</td>';
        echo '</tr>';
    }
    
?>
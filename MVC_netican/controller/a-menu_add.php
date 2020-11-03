<?php
    include_once '../model/menus.php';
    include_once '../model/categoriesPlats.php';
    include_once '../model/plats.php';

    $date = $_REQUEST['date'];

    $laCategorie = new CategoriesPlats();
    $laCategorie->retrieve($_REQUEST['categorie']);

    $lePlat = new Plats();
    $lePlat->retrieve($_REQUEST['plats']);
    
    $file = $_REQUEST['file'];

    $leMenu = new Menus('', $laCategorie, $lePlats, $date, $file);
    $leTicket->create();

    $listMenus = array();
    $listMenus = $leMenu->findAll();

    for ($i=0; $i < count($listMenus); $i++) 
    { 
        echo '<tr>';
            echo '<td>'.$listMenus[$i]->get_dateMenus().'</td>';
            echo '<td>'.$listMenus[$i]->get_lePlat()->get_nom().'</td>';
            echo '<td>'.$listMenus[$i]->get_laCategorie()->get_nom().'</td>';
            echo '<td>';
                echo '<button class="btn btn-primary" onclick="deleteTicket('.$listMenus[$i]->get_id().')"><i class="fas fa-trash"></i> Supprimer</button>';
                echo '<a href="./index.php?action=articles&idTicket='.$listTickets[$i]->get_id().'"><button class="btn btn-secondary"><i class="fas fa-plus"></i> Ajouter articles</button></a>';
            echo '</td>';
        echo '</tr>';
    }
    
?>
<?php
    if (isset($_REQUEST['categorie'])) 
    {
        include_once '../model/categoriesTickets.php';

        $listCategoriesTickets = array();

        $laCategorieTicket = new CategoriesTickets("", $_REQUEST['categorie']);

        $laCategorieTicket->create();

        $listCategoriesTickets = $laCategorieTicket->findAll();
        
        for ($i=0; $i < count($listCategoriesTickets); $i++) 
        { 
            echo '<option value="'.$listCategoriesTickets[$i]->get_id().'">'.$listCategoriesTickets[$i]->get_nom().'</option>';
        }
    }
?>
<?php
    if (isset($_REQUEST['marque'])) 
    {
        include_once '../model/marques.php';

        $listMarques = array();

        $laMarque = new Marques('', $_REQUEST['marque']);
        $laMarque->create();
        
        $laMarque->retrieveByName($_REQUEST['marque']);
        echo '<option value="'.$laMarque->get_id().'" selected>'.$laMarque->get_nom().'</option>';

        $listMarques = $laMarque->findAll();
        for ($i=0; $i < count($listMarques); $i++) 
        { 
            echo '<option value="'.$listMarques[$i]->get_id().'">'.$listMarques[$i]->get_nom().'</option>';
        }
    }
?>
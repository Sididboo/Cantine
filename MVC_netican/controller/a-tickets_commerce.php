<?php
    if (isset($_REQUEST['commerce'])) 
    {
        include_once '../model/commerces.php';

        $listCommerces = array();

        $leCommerce = new Commerces("", $_REQUEST['commerce']);

        $leCommerce->create();

        $listCommerces = $leCommerce->findAll();
        
        for ($i=0; $i < count($listCommerces); $i++) 
        { 
            echo '<option value="'.$listCommerces[$i]->get_id().'">'.$listCommerces[$i]->get_nom().'</option>';
        }
    }
?>
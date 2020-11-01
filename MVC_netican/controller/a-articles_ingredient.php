<?php
    if (isset($_REQUEST['ingredient']) && isset($_REQUEST['sousCategories'])) 
    {
        include_once '../model/ingredients.php';
        include_once '../model/sousCategoriesIngredients.php';

        $listIngredients = array();

        $laSousCategorie = new SousCategoriesIngredients();
        $laSousCategorie->retrieve($_REQUEST['sousCategories']);

        $leIngredient = new Ingredients('', $laSousCategorie, $_REQUEST['ingredient']);
        $leIngredient->create();
        $leIngredient->retrieveByName($_REQUEST['ingredient']);

        $listIngredients = $leIngredient->findAll();

        echo '<option value="'.$leIngredient->get_id().'" selected>'.$leIngredient->get_nom().'</option>';

        for ($i=0; $i < count($listIngredients); $i++) 
        {
            echo '<option value="'.$listIngredients[$i]->get_id().'">'.$listIngredients[$i]->get_nom().'</option>';
        }
    }
    
?>
<?php
    if (isset($_REQUEST['ingredient']) && isset($_REQUEST['sousCategories'])) 
    {
        include_once '../model/ingredients.php';
        include_once '../model/sousCategoriesIngredients.php';
        include_once '../model/categoriesIngredients.php';

        $listCategories = array();
        $listSousCategories = array();
        $listIngredients = array();

        // traitements sous categories
        $laSousCategorie = new SousCategoriesIngredients();
        $laSousCategorie->retrieve($_REQUEST['sousCategories']);
        
        $listSousCategories = $laSousCategorie->findAll();

        $dataSousCategories = '<option value="'.$laSousCategorie->get_id().'" selected>'.$laSousCategorie->get_nom().'</option>';

        for ($i=0; $i < count($listSousCategories); $i++) 
        { 
            $dataSousCategories += '<option value="'.$listSousCategories[$i]->get_id().'">'.$listSousCategories[$i]->get_nom().'</option>';
        }

        // traitements categories
        $laCategorie = new CategoriesIngredients();
        $laCategorie->retrieve($laSousCategorie->get_laCategorie()->get_id());

        $listCategories = $laCategorie->findAll();

        $dataCategories = '<option value="'.$laCategorie->get_id().'" selected>'.$laCategorie->get_nom().'</option>';

        for ($i=0; $i < count($listCategories); $i++) 
        { 
            $dataCategories += '<option value="'.$listCategories[$i]->get_id().'">'.$listCategories[$i]->get_nom().'</option>';
        }

        // traitements ingredients
        $leIngredient = new Ingredients('', $laSousCategorie, $_REQUEST['ingredient']);
        $leIngredient->create();
        $leIngredient->retrieveByName($_REQUEST['ingredient']);

        $listIngredients = $leIngredient->findAll();

        $dataIngredients = '<option value="'.$leIngredient->get_id().'" selected>'.$leIngredient->get_nom().'</option>';

        for ($i=0; $i < count($listIngredients); $i++) 
        {
            $dataIngredients += '<option value="'.$listIngredients[$i]->get_id().'">'.$listIngredients[$i]->get_nom().'</option>';
        }

        echo "$dataCategories;$dataSousCategories;$dataIngredients";
    }
    
?>
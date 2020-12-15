<?php
    // S'il y a ingredient et sousCategorie en methode GET
    if (isset($_REQUEST['ingredient']) && isset($_REQUEST['sousCategorie'])) 
    {
        // On inclut les classes :
        include_once '../model/ingredients.php';
        include_once '../model/sousCategoriesIngredients.php';
        include_once '../model/categoriesIngredients.php';

        // Listes utiles :
        $listCategories = array();
        $listSousCategories = array();
        $listIngredients = array();

        // Variables qui vont contenir les balises option
        $dataSousCategories = '';
        $dataCategories = '';
        $dataIngredients = '';

        // traitements sous categories
        $laSousCategorie = new SousCategoriesIngredients();
        $laSousCategorie->retrieve($_REQUEST['sousCategorie']);
        
        // On renseigne la liste des sousCategories
        $listSousCategories = $laSousCategorie->findAll();

        // On parcours la liste pour creer les balises option
        for ($i=0; $i < count($listSousCategories); $i++) 
        {
            // Si l'id correspond à l'id de l'objet "laSousCategorie" on met l'attribut selected
            if ($listSousCategories[$i]->get_id() == $laSousCategorie->get_id()) 
            {
                $dataSousCategories .= '<option value="'.$laSousCategorie->get_id().'" selected>'.$laSousCategorie->get_nom().'</option>';
            }
            else
            {
                $dataSousCategories .= '<option value="'.$listSousCategories[$i]->get_id().'">'.$listSousCategories[$i]->get_nom().'</option>';
            }
        }

        // traitements categories
        $laCategorie = new CategoriesIngredients();
        $laCategorie->retrieve($laSousCategorie->get_laCategorie()->get_id());

        // On renseigne la liste des categories
        $listCategories = $laCategorie->findAll();

        // On parcours la liste pour creer les balises option
        for ($i=0; $i < count($listCategories); $i++) 
        { 
            // Si l'id correspond à l'id de l'objet "laCategorie" on met l'attribut selected
            if ($listCategories[$i]->get_id() == $laCategorie->get_id()) 
            {
                $dataCategories .= '<option value="'.$laCategorie->get_id().'" selected>'.$laCategorie->get_nom().'</option>';
            }
            else
            {
                $dataCategories .= '<option value="'.$listCategories[$i]->get_id().'">'.$listCategories[$i]->get_nom().'</option>';
            }
        }

        // On créé un objet Ingredients et recherche le nom
        $leIngredient = new Ingredients();
        $leIngredient->retrieveByName($_REQUEST['ingredient']);

        // Si le nom de l'ingredient existe pas
        if ($leIngredient->get_id() < 1)
        {
            // On créé un objet Ingredients
            $leIngredient = new Ingredients('', $laSousCategorie, $_REQUEST['ingredient']);
            // On créé notre ingredient
            $leIngredient->create();
            // On recherche le dernier enregistrement
            $leIngredient->retrieveLast();
        }

        // On renseigne la liste des ingrédients
        $listIngredients = $leIngredient->findAll();

        // On parcours la liste pour creer les balises option
        for ($i=0; $i < count($listIngredients); $i++) 
        {
            // Si l'id correspond à l'id de l'objet "leIngredient" on met l'attribut selected
            if ($listIngredients[$i]->get_id() == $leIngredient->get_id()) 
            {
                $dataIngredients .= '<option value="'.$leIngredient->get_id().'" selected>'.$leIngredient->get_nom().'</option>';
            }
            else
            {
                $dataIngredients .= '<option value="'.$listIngredients[$i]->get_id().'">'.$listIngredients[$i]->get_nom().'</option>';
            }
        }

        // Les différentes listes seront traité par le fichier js v-article_ingredient
        echo "$dataCategories;$dataSousCategories;$dataIngredients";
    }
    
?>
<?php
// Find plat
    if (isset($_REQUEST[''])) {
        
    }

// Find categorieIngredient
    if (isset($_REQUEST['categorie'])) 
    {
        include_once '../model/sousCategoriesIngredients.php';

        $listSousCategories = array();

        $laSousCategorie = new SousCategoriesIngredients();
        $listSousCategories = $laSousCategorie->findAllByCat($_REQUEST['categorie']);

        echo '<option value="0">Choisissez la sous-catégorie</option>';
        for ($i=0; $i < count($listSousCategories); $i++) 
        { 
            echo '<option value="'.$listSousCategories[$i]->get_id().'">'.$listSousCategories[$i]->get_nom().'</option>';
        }
    }

// Find ingredient
    if (isset($_REQUEST['sousCategorie'])) 
    {
        include_once '../model/ingredients.php';

        $listIngredients = array();

        $leIngredient = new Ingredients();
        $listIngredients = $leIngredient->findAllBySousCat($_REQUEST['sousCategorie']);

        echo '<option value="0">Choisissez l\'article</option>';
        for ($i=0; $i < count($listIngredients); $i++) 
        { 
            echo '<option value="'.$listIngredients[$i]->get_id().'">'.$listIngredients[$i]->get_nom().'</option>';
        }
    }
// Find Plat
    if (isset($_REQUEST['categoriePlat'])) 
    {
        include_once '../model/plats.php';

        $listPlats = array();

        $lePlat = new Plats();
        $listPlats = $lePlat->findAllByCat($_REQUEST['categoriePlat']);

        echo '<option value="0">Choisissez le plat</option>';
        for ($i=0; $i < count($listPlats); $i++) 
        { 
            echo '<option value="'.$listPlats[$i]->get_id().'">'.$listPlats[$i]->get_nom().'</option>';
        }
    }
?>
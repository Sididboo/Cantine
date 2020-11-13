<?php
    include "model/categoriesPlats.php";
    include "model/categoriesIngredients.php";
    include "model/ingredients.php";
    $etat = "creationPlat";

    $categorieDesPlats = new CategoriesPlats();
    $tableStock = array();
    $tableStock = $categorieDesPlats->findAll();

    $categorieIngredient = new CategoriesIngredients();
    $tableStockIng = array();
    $tableStockIng = $categorieIngredient->findAll();

    $takeIngredient = new Ingredients();
    $tableIng = array();
    $tableIng = $takeIngredient->retrieve("getCatIngredient");

    if (isset($_POST['namePlat']) &&
    isset($_POST['categoriesPlat']) && 
    isset($_POST['categories']) &&
    isset($_POST['sousCategories'])&&
    isset($_POST['addIngredient']))
    {

    $newCategoriePlat = new CategoriesPlats('','categoriesPlat', 'namePlat','');
    $newCategoriePlat->create();

    }
?>
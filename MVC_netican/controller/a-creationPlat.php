<?php
 include "model/categoriesPlats.php";
 include "model/categoriesIngredients.php";
 include "model/ingredients.php";

 $categorieDesPlats = new CategoriesPlats();
 $tableStock = array();
 $tableStock = $categorieDesPlats->findAll();


 $categorieIngredient = new CategoriesIngredients();
 $tableStockIng = array();
 $tableStockIng= $categorieIngredient->findAll();

$takeIngredient = new Ingredients();
$tableIng = array();
$tableIng = $takeIngredient->retrieve("getCatIngredient");

$etat = "creationPlat";


?>
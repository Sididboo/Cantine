<?php
 include "model/categoriesPlats.php";
 include "model/categoriesIngredients.php";

 $categorieDesPlats = new CategoriesPlats();
 $tableStock = array();
 $tableStock = $categorieDesPlats->findAll();



 $categorieIngredient = new CategoriesIngredients();
 $tableStockIng = array();
 $tableStockIng= $categorieIngredient->findAll();

 $etat = "creationPlat";
?>
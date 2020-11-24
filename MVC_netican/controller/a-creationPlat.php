<?php
include "model/categoriesPlats.php";
include "model/categoriesIngredients.php";
include "model/ingredients.php";
include "model/utilise.php";
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

if (
  $_POST['namePlats'] &&
  $_POST['quantity'] &&
  $_POST['categoriesPlat'] &&
  $_POST['categories'] &&
  $_POST['sousCategories'] &&
  $_POST['ingredients'] &&
  $_POST['addIngredient'] &&
  $_POST['utilise']
) {

  $selectCatPlat = new CategoriesPlats($_POST['categoriesPlat']);
  $newPlat = new Plats('',$selectCatPlat, $_POST['namePlats'], $_POST['quantity']);
  $newPlat->create();

  $NewPlat = new Plats();
  $idNewPlat = $newPlat->findMax();
  
  $PlatReturn = new Plats();
  $PlatReturn->retrieve($idNewPlat);
  $PlatReturn->create();
  for ($i = 0; $i < count($_POST['addIngredient']); $i++) {

    $selectCatIng = new CategoriesIngredients();
    $selectCatIng->retrieve($_POST['categories']);
    $selectSousCatIng = new SousCategoriesIngredients($_POST['sousCategories'],$selectCatIng);
    $selectIngredient = new Ingredients();
    $selectIngredient->retrieve($_POST['addIngredient'][$i], $newPlat->get_id());

    $utilisation = new Utilise($selectIngredient, $PlatReturn, $_POST['utilise'][$i]);
   // echo $utilisation->get_leIngredient()->get_id();
    $utilisation->create();
  }

}

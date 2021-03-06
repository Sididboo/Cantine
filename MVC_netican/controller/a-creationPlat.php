<?php
include "model/categoriesPlats.php";
include "model/categoriesIngredients.php";
include "model/ingredients.php";
include "model/unites.php";
include "model/utilise.php";

/* 
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
  isset($_POST['namePlats']) &&
  isset($_POST['quantity']) &&
  isset($_POST['categoriesPlat']) &&
  isset($_POST['categories']) &&
  isset($_POST['sousCategories']) &&
  isset($_POST['ingredients']) &&
  isset($_POST['addIngredient']) &&
  isset($_POST['utilise'])
) {

  $selectCatPlat = new CategoriesPlats($_POST['categoriesPlat']);
  $newPlat = new Plats('',$selectCatPlat, $_POST['namePlats'], $_POST['quantity']);
  $newPlat->create();

  $NewPlat = new Plats();
  $idNewPlat = $newPlat->findMax();
  
  $PlatReturn = new Plats();
  $PlatReturn->retrieve($idNewPlat);

  for ($i = 0; $i < count($_POST['addIngredient']); $i++) {

    $selectCatIng = new CategoriesIngredients();
    $selectCatIng->retrieve($_POST['categories']);
    $selectSousCatIng = new SousCategoriesIngredients($_POST['sousCategories'],$selectCatIng);
    $selectIngredient = new Ingredients();
    $selectIngredient->retrieve($_POST['addIngredient'][$i], $newPlat->get_id());

    $utilisation = new Utilise($selectIngredient, $PlatReturn, $_POST['utilise'][$i]);
    $utilisation->create();
  }

}
*/

/* Création d'un objet Plat qui contiendra l'ensemble des plats contenu dans la base de donnée */
/* Utilisation de la méthode findAll qui récupère l'ensemble des valeurs de la base de donnée */
$lesPlats = new Plats();
$selectLesPlats = $lesPlats->findAll();

/* Permet l'affichage des catégories de plat dans le formulaire */
$categorieDesPlats = new CategoriesPlats();
$tableStock = [];
$tableStock = $categorieDesPlats->findAll();

/* Permet l'affichage des ingrédients */
$categorieIngredient = new CategoriesIngredients();
$tableStockIng = [];
$tableStockIng = $categorieIngredient->findAll();


/* Permet l'affichage de toute les unités */
$uniteMesure = new Unites();
$allUnite = [];
$allUnite = $uniteMesure->findAll();

$lesIngredients = new Utilise();

$etat = "creationPlat";

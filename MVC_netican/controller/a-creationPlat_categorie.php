<?php

// Importation de la classe concerné
include_once '../model/categoriesPlats.php';

$laCreationPlat = new CategoriesPlats("", $_REQUEST['categorie']);
$laCreationPlat->create();

echo $_REQUEST['categorie'];

?>
<?php

//On inclut les classes
include_once '../model/plats.php';
include_once '../model/categoriesPlats.php';

// On renseigne les objets concernés

/*
$laCategoriePlat = new CategoriesPlats();
$laCategoriePlat->retrieve($_REQUEST["categoriesPlat"]);
*/

$laCtg = new CategoriesPlats($_REQUEST["categoriePlat"]);

$newPlat = new Plats(
    null,
    $laCtg,
    $_REQUEST["nomPlat"],
    $_REQUEST["nbPersonne"]
);
$newPlat->create();

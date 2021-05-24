<?php


if (isset($_REQUEST["idPlat"])) {

    include_once "../model/plats.php";
    include_once "../model/utilise.php";


    $monPlat = new Plats();
    $monPlat->retrieve($_REQUEST['idPlat']);

    $mesIngredient = new Utilise();
    $lesIngredients = [];
    $lesIngredients = $mesIngredient->findAllByIdPlat($monPlat->get_id());

    for ($i = 0; $i < count($lesIngredients); $i++) {
        $lesIngredients[$i]->delete();
    }

    $monPlat->delete();
}

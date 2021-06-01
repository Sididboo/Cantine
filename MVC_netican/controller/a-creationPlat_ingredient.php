<?php

include_once '../model/plats.php';
include_once '../model/utilise.php';
include_once '../model/ingredients.php';

$monDernierPlat = new Plats();
$idLastPlat = intval($monDernierPlat->findMax());
$monDernierPlat->retrieve($idLastPlat);
$monIngredient = new Ingredients();

/*
for ($i = 0; $i < count($sendInfo = $_REQUEST["table"]); $i++) {
    $monIngredient = new Ingredients();
    $monIngredient = $monIngredient->retrieve($_REQUEST["idIngredient"]);

    $utilisation = new Utilise($monIngredient, $monDernierPlat, $_REQUEST["quantite"]);

    echo var_dump($utilisation);
    $utilisation->create();
}
*/

$data = json_decode(stripslashes($_REQUEST["data"]));

echo var_dump($data);

foreach ($data as $key => $value) {
   /*     echo var_dump($value->ingredient);
 */
   $idIngredient = intval($value->ingredient);
   $numQte = intval($value->qte);




   /*     echo gettype($value->ingredient);
 */
   $monIngredient->retrieve($idIngredient);

   /*     echo gettype($monIngredient);
 */
   $utilisation = new Utilise($monIngredient, $monDernierPlat, $numQte);

   /*     echo var_dump($utilisation);
 */
   $utilisation->create();
}
/*
$monIngredient = new Ingredients();
$monIngredient = $monIngredient->retrieve($_REQUEST["idIngredient"]);

$utilisation = new Utilise($monIngredient, $monDernierPlat, $_REQUEST["quantite"]);

echo var_dump($utilisation);
$utilisation->create();*/

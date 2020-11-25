<?php

include_once 'accesBDD.php';

include_once 'plats.php';
include_once 'ingredients.php';

class Utilise
{
  // Attributs
  private $_util_leIngredient;
  private $_util_lePlat;
  private $_util_dose;

  // Constructeur
  function __construct($leIngredient = null, $lePlat = null, $dose = "")
  {
    $this->_util_leIngredient = $leIngredient;
    $this->_util_lePlat = $lePlat;
    $this->_util_dose = $dose;
  }

  // Méthode findAll
  public function findAll()
  {
    $bdd = BDD::getBDD();

    $listUtilise = array();

    // Requête SQL
    $sql = "SELECT * FROM utilise";
    // On execute la requête
    $result = $bdd->query($sql);

    while ($row = $result->fetch()) {
      $leIngredient = new Ingredients();
      $leIngredient->retrieve($row['IDINGREDIENT']);

      $lePLat = new Plats();
      $lePLat->retrieve($row['IDPLAT']);

      $utilise = new Utilise($leIngredient, $lePLat, $row['DOSE']);
      array_push($listUtilise, $utilise);
    }

    return $listUtilise;
  }

  public function findAllByIdPlat($idPlat)
  {
    $bdd = BDD::getBDD();

    $listUtilise = array();

    // Requête SQL
    $sql = "SELECT * FROM utilise WHERE IDPLAT=".$idPlat;

    // On execute la requête
    $result = $bdd->query($sql);

    while ($row = $result->fetch()) {
      $leIngredient = new Ingredients();
      $leIngredient->retrieve($row['IDINGREDIENT']);

      $lePLat = new Plats();
      $lePLat->retrieve($row['IDPLAT']);

      $utilise = new Utilise($leIngredient, $lePLat, $row['DOSE']);
      array_push($listUtilise, $utilise);
    }

    return $listUtilise;
  }

  // Méthode retrieve
  public function retrieve($idIngredient, $idPlat)
  {
    $bdd = BDD::getBDD();

    // Requête SQL
    $sql = "SELECT * FROM utilise WHERE IDINGREDIENT='" . $idIngredient . "' AND IDPLAT=" . $idPlat;
    // On execute la requête
    $result = $bdd->query($sql);
    // On récup les résultats dans un tableau
    $data = $result->fetch();

    $leIngredient = new Ingredients();
    $leIngredient->retrieve($data['IDINGREDIENT']);

    $lePlat = new Plats();
    $lePlat->retrieve($data['IDPLAT']);

    // Traitements
    $this->_util_idIngredient = $leIngredient;
    $this->_util_lePlat = $lePlat;
    $this->_util_dose = $data['DOSE'];
  }

  // Méthode create
  public function create()
  {
    $bdd = BDD::getBDD();
    // Requête SQL
    $sql = "INSERT INTO utilise (IDINGREDIENT, IDPLAT, DOSE) VALUES ('" . $this->_util_leIngredient->get_id() . "','" . $this->_util_lePlat->get_id() . "','" . $this->_util_dose . "')";
    // On execute la requête
    $bdd->exec($sql);
  }

  // Méthode delete
  public function delete()
  {
    $bdd = BDD::getBDD();
    // Requête SQL
    $sql = "DELETE FROM utilise WHERE IDINGREDIENT='" . intval($this->_util_leIngredient->get_id()) . "' AND IDPLAT= '" . $this->_util_lePlat->get_id() . "'";
    // On execute la requête
    $bdd->exec($sql);
  }

  public function get_leIngredient()
  {
    return $this->_util_leIngredient;
  }

  public function get_lePlat()
  {
    return $this->_util_lePlat;
  }

  public function get_dose()
  {
    return $this->_util_dose;
  }
}

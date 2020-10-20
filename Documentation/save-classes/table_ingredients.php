<?php

  include_once '../server/accesBDD.php';

  class Ingredients
  {

    // Attributs
    private $_ingr_id;
    private $_ingr_idSousCategorie;
    private $_ingr_name;

    // Constructeur
    public function __construct($id="", $idSousCategorie="", $name="")
    {
      $this->_ingr_id = $id;
      $this->_ingr_idSousCategorie = $idSousCategorie;
      $this->_ingr_name = $name;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM ingredients";
      // La méthode prepare() permet de préparer la requête sql à être exécutée
      $result = $bdd->prepare($sql);
      // On execute la requête
      $result->execute();

      return $result;
    }

    // Méthode findAll
    public function findAllCondition($condition="")
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM ingredients WHERE ".$condition;
      // On execute la requête
      $result = $bdd->query($sql);

      return $result;
    }

    // Méthode retrieve
    public function retrieve($id="", $idSousCategorie="", $name="")
    {
      $bdd = BDD::getBDD();

      if ($id != "")
      {
        // Requête SQL
        $sql = "SELECT * FROM ingredients WHERE IDINGREDIENT = '$id' ";
        // On execute la requête
        $result = $bdd->query($sql);
        // On récup les résultats dans un tableau
        $data = $result->fetchAll();

        // Traitements
        $this->_ingr_id = $data[0]['IDINGREDIENT'];
        $this->_ingr_idSousCategorie = $data[0]['IDSOUSCATEGORIEINGREDIENT'];
        $this->_ingr_name = $data[0]['NOMINGREDIENT'];
      }
        elseif ($idSousCategorie != "")
        {
          // Requête SQL
          $sql = "SELECT * FROM ingredients WHERE IDSOUSCATEGORIEINGREDIENT = '$idSousCategorie' ORDER BY NOMINGREDIENT";
          // On execute la requête
          $result = $bdd->query($sql);

          // Traitements
          while ($row = $result->fetch())
          {
            echo '<option value="'.$row['IDINGREDIENT'].'">'.$row['NOMINGREDIENT'].'</option>';
          }
        }
          else
          {
            // Requête SQL
            $sql = "SELECT * FROM ingredients WHERE NOMINGREDIENT = '$name' ";
            // La méthode prepare() permet de préparer la requête sql à être exécutée
            $result = $bdd->prepare($sql);
            // On execute la requête
            $result->execute();
            // On récup les résultats dans un tableau
            $data = $result->fetchAll();

            // Traitements
            $this->_ingr_id = $data[0]['IDINGREDIENT'];
            $this->_ingr_idSousCategorie = $data[0]['IDSOUSCATEGORIEINGREDIENT'];
            $this->_ingr_name = $data[0]['NOMINGREDIENT'];
          }
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO ingredients (IDSOUSCATEGORIEINGREDIENT, NOMINGREDIENT) VALUES ('" . $this->_ingr_idSousCategorie . "','" . $this->_ingr_name . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM ingredients WHERE '" . $this->_ingr_name . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_ingr_id;
    }

    public function get_idSousCategorie()
    {
      return $this->_ingr_idSousCategorie;
    }

    public function get_name()
    {
      return $this->_ingr_name;
    }

  }

?>

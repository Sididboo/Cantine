<?php

  include_once '../server/accesBDD.php';

  class SousCategoriesIngredients
  {

    // Attributs
    private $_scai_id;
    private $_scai_idCategorie;
    private $_scai_name;

    // Constructeur
    public function __construct($id="", $idCategorie="", $name="")
    {
      $this->_scai_id = $id;
      $this->_scai_idCategorie = $idCategorie;
      $this->_scai_name = $name;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM souscategoriesingredients";
      // La méthode prepare() permet de préparer la requête sql à être exécutée
      $result = $bdd->prepare($sql);
      // On execute la requête
      $result->execute();

      return $result;
    }

    // Méthode retrieve
    public function retrieve($id="", $idCategorie="", $name="")
    {
      $bdd = BDD::getBDD();

      if ($id != "") {
        // Requête SQL
        $sql = "SELECT * FROM souscategoriesingredients WHERE IDSOUSCATEGORIEINGREDIENT = '$id' ";
        // La méthode prepare() permet de préparer la requête sql à être exécutée
        $result = $bdd->prepare($sql);
        // On execute la requête
        $result->execute();
        // On récup les résultats dans un tableau
        $data = $result->fetchAll();

        // Traitements
        $this->_scai_id = $data[0]['IDSOUSCATEGORIEINGREDIENT'];
        $this->_scai_idCategorie = $data[0]['IDCATEGORIEINGREDIENT'];
        $this->_scai_name = $data[0]['NOMSOUSCATEGORIEINGREDIENT'];
      }
        elseif ($idCategorie != "")
        {
          // Requête SQL
          $sql = "SELECT * FROM souscategoriesingredients WHERE IDCATEGORIEINGREDIENT = '$idCategorie' ORDER BY NOMSOUSCATEGORIEINGREDIENT";
          // La méthode prepare() permet de préparer la requête sql à être exécutée
          $result = $bdd->prepare($sql);
          // On execute la requête
          $result->execute();

          // Traitements
          echo '<option value="">Choisir une sous catégorie</option>';
          while ($row = $result->fetch())
          {
            echo '<option value="'.$row['IDSOUSCATEGORIEINGREDIENT'].'">'.$row['NOMSOUSCATEGORIEINGREDIENT'].'</option>';
          }
        }
          else
          {
            // Requête SQL
            $sql = "SELECT * FROM souscategoriesingredients WHERE NOMSOUSCATEGORIEINGREDIENT = '$name' ";
            // La méthode prepare() permet de préparer la requête sql à être exécutée
            $result = $bdd->prepare($sql);
            // On execute la requête
            $result->execute();
            // On récup les résultats dans un tableau
            $data = $result->fetchAll();

            // Traitements
            $this->_scai_id = $data[0]['IDSOUSCATEGORIEINGREDIENT'];
            $this->_scai_idCategorie = $data[0]['IDCATEGORIEINGREDIENT'];
            $this->_scai_name = $data[0]['NOMSOUSCATEGORIEINGREDIENT'];
          }
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO souscategoriesingredients (NOMSOUSCATEGORIEINGREDIENT) VALUES ('" . $this->_scai_name . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM souscategoriesingredients WHERE '" . $this->_scai_name . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_scai_id;
    }

    public function get_idCategorie()
    {
      return $this->_scai_idCategorie;
    }

    public function get_name()
    {
      return $this->_scai_name;
    }

  }

?>

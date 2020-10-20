<?php

  include_once '../server/accesBDD.php';

  class CategoriesIngredients
  {

    // Attributs
    private $_cati_id;
    private $_cati_name;

    // Constructeur
    public function __construct($id="", $name="")
    {
      $this->_cati_id = $id;
      $this->_cati_name = $name;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM categoriesingredients ORDER BY NOMCATEGORIEINGREDIENT";
      // La méthode prepare() permet de préparer la requête sql à être exécutée
      $result = $bdd->prepare($sql);
      // On execute la requête
      $result->execute();

      // Traitements
      while ($row = $result->fetch())
      {
        echo '<option value="'.$row['IDCATEGORIEINGREDIENT'].'">'.$row['NOMCATEGORIEINGREDIENT'].'</option>';
      }
    }

    // Méthode retrieve
    public function retrieve($id="", $name="")
    {
      $bdd = BDD::getBDD();

      if ($id != "")
      {
        // Requête SQL
        $sql = "SELECT * FROM categoriesingredients WHERE IDCATEGORIEINGREDIENT = '$id' ";
        // La méthode prepare() permet de préparer la requête sql à être exécutée
        $result = $bdd->prepare($sql);
        // On execute la requête
        $result->execute();
        // On récup les résultats dans un tableau
        $data = $result->fetchAll();

        // Traitements
        $this->_cati_id = $data[0]['IDCATEGORIEINGREDIENT'];
        $this->_cati_name = $data[0]['NOMCATEGORIEINGREDIENT'];
      }
        else
        {
          // Requête SQL
          $sql = "SELECT * FROM categoriesingredients WHERE NOMCATEGORIEINGREDIENT = '$name' ";
          // La méthode prepare() permet de préparer la requête sql à être exécutée
          $result = $bdd->prepare($sql);
          // On execute la requête
          $result->execute();
          // On récup les résultats dans un tableau
          $data = $result->fetchAll();

          // Traitements
          $this->_cati_id = $data[0]['IDCATEGORIEINGREDIENT'];
          $this->_cati_name = $data[0]['NOMCATEGORIEINGREDIENT'];
        }
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO categoriesingredients (NOMCATEGORIEINGREDIENT) VALUES ('" . $this->_cati_name . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM categoriesingredients WHERE '" . $this->_cati_name . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_cati_id;
    }

    public function get_name()
    {
      return $this->_cati_name;
    }

  }

?>

<?php

  include_once './server/accesBDD.php';

  class CategoriesIngredients
  {

    // Attributs
    private $_cati_id;
    private $_cati_nom;
    private $_cati_lesSousCategories = array();

    // Constructeur
    public function __construct($id="", $nom="")
    {
      $this->_cati_id = $id;
      $this->_cati_nom = $nom;
      $this->_cati_lesSousCategories = array();
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listCategories = array();

      // Requête SQL
      $sql = "SELECT * FROM categoriesingredients ORDER BY NOMCATEGORIEINGREDIENT";
      // On execute la requête
      $result = $bdd->query($sql);

      // Traitements
      while ($row = $result->fetch())
      {
        $laCategorie = new CategoriesIngredients($row['IDCATEGORIEINGREDIENT'], $row['NOMCATEGORIEINGREDIENT']);
        array_push($listCategories, $laCategorie);
      }

      return $listCategories;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM categoriesingredients WHERE IDCATEGORIEINGREDIENT='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_cati_id = $data['IDCATEGORIEINGREDIENT'];
      $this->_cati_nom = $data['NOMCATEGORIEINGREDIENT'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO categoriesingredients (NOMCATEGORIEINGREDIENT) VALUES ('" . $this->_cati_nom . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM categoriesingredients WHERE IDCATEGORIEINGREDIENT='" . $this->_cati_id . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_cati_id;
    }

    public function get_nom()
    {
      return $this->_cati_nom;
    }

  }

?>

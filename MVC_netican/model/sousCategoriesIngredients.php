<?php

  include_once './server/accesBDD.php';

  include_once 'categoriesIngredients.php';

  class SousCategoriesIngredients
  {

    // Attributs
    private $_scai_id;
    private $_scai_laCategorie;
    private $_scai_nom;
    private $_scai_lesIngredients = array();

    // Constructeur
    public function __construct($id="", $laCategorie=null, $nom="")
    {
      $this->_scai_id = $id;
      $this->_scai_laCategorie = $laCategorie;
      $this->_scai_nom = $nom;
      $this->_scai_lesIngredients = array();
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listSousCategories = array();

      // Requête SQL
      $sql = "SELECT * FROM souscategoriesingredients ORDER BY NOMSOUSCATEGORIEINGREDIENT";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $laCategorie = new CategoriesIngredients();
        $laCategorie->retrieve($row['IDCATEGORIEINGREDIENT']);

        $laSousCategorie = new SousCategoriesIngredients($row['IDSOUSCATEGORIEINGREDIENT'], $laCategorie, $row['NOMSOUSCATEGORIEINGREDIENT']);
        array_push($listSousCategories, $laSousCategorie);
      }

      return $listSousCategories;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM souscategoriesingredients WHERE IDSOUSCATEGORIEINGREDIENT='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      // Traitements
      $laCategorie = new CategoriesIngredients();
      $laCategorie->retrieve($data['IDCATEGORIEINGREDIENT']);

      $this->_scai_id = $data['IDSOUSCATEGORIEINGREDIENT'];
      $this->_scai_laCategorie = $laCategorie;
      $this->_scai_nom = $data['NOMSOUSCATEGORIEINGREDIENT'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO souscategoriesingredients (IDCATEGORIEINGREDIENT, NOMSOUSCATEGORIEINGREDIENT) VALUES ('".$this->_scai_laCategorie->get_nom()."', '".$this->_scai_nom."')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM souscategoriesingredients WHERE IDSOUSCATEGORIEINGRDIENT='".$this->_scai_id."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_scai_id;
    }

    public function get_laCategorie()
    {
      return $this->_scai_laCategorie;
    }

    public function get_nom()
    {
      return $this->_scai_nom;
    }

  }

?>

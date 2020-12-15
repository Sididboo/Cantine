<?php

  include_once 'accesBDD.php';

  include_once 'sousCategoriesIngredients.php';

  class Ingredients
  {

    // Attributs
    private $_ingr_id;
    private $_ingr_laSousCategorie;
    private $_ingr_nom;
    private $_ingr_lesUtilisations = array();
    private $_ingr_lesProduits = array();

    // Constructeur
    public function __construct($id=0, $laSousCategorie=null, $nom="")
    {
      $this->_ingr_id = $id;
      $this->_ingr_laSousCategorie = $laSousCategorie;
      $this->_ingr_nom = $nom;
      $this->_ingr_lesUtilisations = array();
      $this->_ingr_lesProduits = array();
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listIngredients = array();

      // Requête SQL
      $sql = "SELECT * FROM ingredients ORDER BY NOMINGREDIENT";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $laSousCategorie = new SousCategoriesIngredients();
        $laSousCategorie->retrieve($row['IDSOUSCATEGORIEINGREDIENT']);

        $leIngredient = new Ingredients($row['IDINGREDIENT'], $laSousCategorie, $row['NOMINGREDIENT']);
        array_push($listIngredients, $leIngredient);
      }

      return $listIngredients;
    }

    // Méthode findAllByCat
    public function findAllByCat($idCategorie)
    {
      $bdd = BDD::getBDD();

      $listIngredients = array();

      // Requête SQL
      $sql = "SELECT i.IDINGREDIENT, i.IDSOUSCATEGORIEINGREDIENT, i.NOMINGREDIENT FROM ingredients AS i INNER JOIN souscategoriesingredients AS sci ON i.IDSOUSCATEGORIEINGREDIENT = sci.IDSOUSCATEGORIEINGREDIENT INNER JOIN categoriesingredients AS ci ON sci.IDCATEGORIEINGREDIENT = ci.IDCATEGORIEINGREDIENT WHERE ci.IDCATEGORIEINGREDIENT = '".$idCategorie."' ORDER BY NOMINGREDIENT";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $laSousCategorie = new SousCategoriesIngredients();
        $laSousCategorie->retrieve($row['IDSOUSCATEGORIEINGREDIENT']);

        $leIngredient = new Ingredients($row['IDINGREDIENT'], $laSousCategorie, $row['NOMINGREDIENT']);
        array_push($listIngredients, $leIngredient);
      }

      return $listIngredients;
    }

    // Méthode findAllBySousCat
    public function findAllBySousCat($idSousCategorie)
    {
      $bdd = BDD::getBDD();

      $listIngredients = array();

      // Requête SQL
      $sql = "SELECT * FROM ingredients NATURAL JOIN souscategoriesingredients WHERE IDSOUSCATEGORIEINGREDIENT= '".$idSousCategorie."' ORDER BY NOMINGREDIENT";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $laSousCategorie = new SousCategoriesIngredients();
        $laSousCategorie->retrieve($row['IDSOUSCATEGORIEINGREDIENT']);

        $leIngredient = new Ingredients($row['IDINGREDIENT'], $laSousCategorie, $row['NOMINGREDIENT']);
        array_push($listIngredients, $leIngredient);
      }

      return $listIngredients;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM ingredients WHERE IDINGREDIENT='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup le résultat dans un tableau
      $data = $result->fetch();

      // Traitements
      $laSousCategorie = new SousCategoriesIngredients();
      $laSousCategorie->retrieve($data['IDSOUSCATEGORIEINGREDIENT']);

      $this->_ingr_id = $data['IDINGREDIENT'];
      $this->_ingr_laSousCategorie = $laSousCategorie;
      $this->_ingr_nom = $data['NOMINGREDIENT'];
    }

    // Méthode retrieve
    public function retrieveByName($name)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM ingredients WHERE UCASE(NOMINGREDIENT)='".$name."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup le résultat dans un tableau
      $data = $result->fetch();

      // Traitements
      $laSousCategorie = new SousCategoriesIngredients();
      $laSousCategorie->retrieve($data['IDSOUSCATEGORIEINGREDIENT']);

      $this->_ingr_id = $data['IDINGREDIENT'];
      $this->_ingr_laSousCategorie = $laSousCategorie;
      $this->_ingr_nom = $data['NOMINGREDIENT'];
    }

    // Méthode retrieve
    public function retrieveLast()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = 'SELECT *
              FROM ingredients 
              ORDER BY IDINGREDIENT DESC LIMIT 1';

      // On execute la requête
      $result = $bdd->query($sql);
      // On récup le résultat dans un tableau
      $data = $result->fetch();

      // Traitements
      $laSousCategorie = new SousCategoriesIngredients();
      $laSousCategorie->retrieve($data['IDSOUSCATEGORIEINGREDIENT']);

      $this->_ingr_id = $data['IDINGREDIENT'];
      $this->_ingr_laSousCategorie = $laSousCategorie;
      $this->_ingr_nom = $data['NOMINGREDIENT'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO ingredients (IDSOUSCATEGORIEINGREDIENT, NOMINGREDIENT) VALUES ('" . $this->_ingr_laSousCategorie->get_id() . "','" . $this->_ingr_nom . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM ingredients WHERE IDINGREDIENT='".$this->_ingr_nom."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_ingr_id;
    }

    public function get_laSousCategorie()
    {
      return $this->_ingr_laSousCategorie;
    }

    public function get_nom()
    {
      return $this->_ingr_nom;
    }

  }

?>

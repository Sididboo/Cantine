<?php

  include_once 'accesBDD.php';

  include_once 'pays.php';
  include_once 'marques.php';
  include_once 'unites.php';
  include_once 'typesConditionnements.php';
  include_once 'ingredients.php';

  class Produits
  {
    // Attributs
    private $_prod_id;
    private $_prod_lePays;
    private $_prod_laMarque;
    private $_prod_laUnite;
    private $_prod_leTypeConditionnement;
    private $_prod_leIngredient;
    private $_prod_codeBarre;
    private $_prod_quantiteConditionnement;
    private $_prod_lesProduitsAchetes;

    public function __construct($id="", $lePays=null, $laMarque=null, $laUnite=null, $leTypeConditionnement=null, $leIngredient=null, $codeBarre="", $quantiteConditionnement=0)
    {
      $this->_prod_id = $id;
      $this->_prod_lePays = $lePays;
      $this->_prod_laMarque = $laMarque;
      $this->_prod_laUnite = $laUnite;
      $this->_prod_leTypeConditionnement = $leTypeConditionnement;
      $this->_prod_leIngredient = $leIngredient;
      $this->_prod_codeBarre = $codeBarre;
      $this->_prod_quantiteConditionnement = $quantiteConditionnement;
      $this->_prod_lesProduitsAchetes = array();
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listProduits = array();

      // Requête SQL
      $sql = "SELECT * FROM produits";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $lePays = new Pays();
        $lePays->retrieve($row['IDPAYS']);

        $laMarque = new Marques();
        $laMarque->retrieve($row['IDMARQUE']);

        $laUnite = new Unites();
        $laUnite->retrieve($row['IDUNITE']);

        $leTypeConditionnement = new TypesConditionnements();
        $leTypeConditionnement->retrieve($row['IDTYPECONDITIONNEMENT']);

        $leIngredient = new Ingredients();
        $leIngredient->retrieve($row['IDINGREDIENT']);

        $leProduit = new Produits($row['IDPRODUIT'], $lePays, $laMarque, $laUnite, $leTypeConditionnement, $leIngredient, $row['CODEBARRE'], $row['QUANTITECONDITIONNEMENT']);
        array_push($listProduits, $leProduit);
      }

      return $listProduits;
    }

    // Méthode retrieve
    public function retrieve($idProduit)
    {
      $bdd = BDD::getBDD();

      // Requête
      $sql = "SELECT * FROM produits WHERE IDPRODUIT='".$idProduit."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetch();

        $this->_prod_id = $data['IDPRODUIT'];

        $lePays = new Pays();
        $lePays->retrieve($data['IDPAYS']);
        $this->_prod_lePays = $lePays;

        $laMarque = new Marques();
        $laMarque->retrieve($data['IDMARQUE']);
        $this->_prod_laMarque = $laMarque;

        $laUnite = new Unites();
        $laUnite->retrieve($data['IDUNITE']);
        $this->_prod_laUnite = $laUnite;

        $leTypeConditionnement = new TypesConditionnements();
        $leTypeConditionnement->retrieve($data['IDTYPECONDITIONNEMENT']);
        $this->_prod_leTypeConditionnement = $leTypeConditionnement;

        $leIngredient = new Ingredients();
        $leIngredient->retrieve($data['IDINGREDIENT']);
        $this->_prod_leIngredient = $leIngredient;

        $this->_prod_codeBarre = $data['CODEBARRE'];
        $this->_prod_quantiteConditionnement = $data['QUANTITECONDITIONNEMENT'];
    }

    // Méthode retrieve by code-barre
    public function retrieveByCodeBarre($codeBarre)
    {
      $bdd = BDD::getBDD();

      // Requête
      $sql = "SELECT * FROM produits WHERE CODEBARRE='".$codeBarre."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetch();

      $this->_prod_id = $data['IDPRODUIT'];

      $lePays = new Pays();
      $lePays->retrieve($data['IDPAYS']);
      $this->_prod_lePays = $lePays;

      $laMarque = new Marques();
      $laMarque->retrieve($data['IDMARQUE']);
      $this->_prod_laMarque = $laMarque;

      $laUnite = new Unites();
      $laUnite->retrieve($data['IDUNITE']);
      $this->_prod_laUnite = $laUnite;

      $leTypeConditionnement = new TypesConditionnements();
      $leTypeConditionnement->retrieve($data['IDTYPECONDITIONNEMENT']);
      $this->_prod_leTypeConditionnement = $leTypeConditionnement;

      $leIngredient = new Ingredients();
      $leIngredient->retrieve($data['IDINGREDIENT']);
      $this->_prod_leIngredient = $leIngredient;

      $this->_prod_codeBarre = $data['CODEBARRE'];
      $this->_prod_quantiteConditionnement = $data['QUANTITECONDITIONNEMENT'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();

      $sql = "INSERT INTO produits (IDPAYS, IDMARQUE, IDUNITE, IDTYPECONDITIONNEMENT, IDINGREDIENT, CODEBARRE, QUANTITECONDITIONNEMENT)
        VALUES ('".$this->_prod_lePays->get_id()."',";
      
      if (empty($this->_prod_laMarque->get_id()))             
      {
        $sql .= "NULL,";
      }
      else
      {
        $sql .= "'".$this->_prod_laMarque->get_id()."',";
      }
      // Requête SQL
       $sql .= "'".$this->_prod_laUnite->get_id()."','".$this->_prod_leTypeConditionnement->get_id()."','".$this->_prod_leIngredient->get_id()."','".$this->_prod_codeBarre."','".$this->_prod_quantiteConditionnement."')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete($idProduit)
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM produits WHERE IDPRODUIT='".$idProduit."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Getters
    public function get_id()
    {
      return $this->_prod_id;
    }

    public function get_lePays()
    {
      return $this->_prod_lePays;
    }

    public function get_laMarque()
    {
      return $this->_prod_laMarque;
    }

    public function get_laUnite()
    {
      return $this->_prod_laUnite;
    }

    public function get_leTypeConditionnement()
    {
      return $this->_prod_leTypeConditionnement;
    }

    public function get_leIngredient()
    {
      return $this->_prod_leIngredient;
    }

    public function get_codeBarre()
    {
      return $this->_prod_codeBarre;
    }

    public function get_quantiteConditionnement()
    {
      return $this->_prod_quantiteConditionnement;
    }

  }
?>

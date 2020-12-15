<?php

  include_once 'accesBDD.php';

  class CategoriesTickets
  {

    // Attributs
    private $_catt_id;
    private $_catt_nom;

    // Constructeur
    public function __construct($id="", $nom="")
    {
      $this->_catt_id = $id;
      $this->_catt_nom = $nom;
    }

    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listCategories = array();

      // Requête SQL
      $sql = "SELECT * FROM categoriestickets ORDER BY NOMCATEGORIETICKET";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $laCategorie = new CategoriesTickets($row['IDCATEGORIETICKET'], $row['NOMCATEGORIETICKET']);
        array_push($listCategories, $laCategorie);
      }

      return $listCategories;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM categoriestickets WHERE IDCATEGORIETICKET='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetch();
      // On renseigne les attributs
      $this->_catt_id = $data['IDCATEGORIETICKET'];
      $this->_catt_nom = $data['NOMCATEGORIETICKET'];
    }

    // Méthode retrieveLast
    public function retrieveLast()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * 
              FROM categoriestickets 
              ORDER BY IDCATEGORIETICKET DESC LIMIT 1";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup le résultat dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_catt_id = $data['IDCATEGORIETICKET'];
      $this->_catt_nom = $data['NOMCATEGORIETICKET'];
    }

    // Méthode retrieveByName
    public function retrieveByName($name)
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM categoriestickets WHERE UCASE(NOMCATEGORIETICKET)='".$name."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetch();
      // On renseigne les attributs
      $this->_catt_id = $data['IDCATEGORIETICKET'];
      $this->_catt_nom = $data['NOMCATEGORIETICKET'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO categoriestickets (NOMCATEGORIETICKET) VALUES ('" . $this->_catt_nom . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM categoriestickets WHERE IDCATEGORIETICKET='" . $this->_catt_id . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_catt_id;
    }

    public function get_nom()
    {
      return $this->_catt_nom;
    }
  }

?>

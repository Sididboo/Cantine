<?php

  include_once '../server/accesBDD.php';

  class CategoriesTickets
  {

    // Attributs
    private $_catt_id;
    private $_catt_name;

    // Constructeur
    public function __construct($id="", $name="")
    {
      $this->_catt_id = $id;
      $this->_catt_name = $name;
    }

    public function findAll()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM categoriestickets";
      // On execute la requête
      $result = $bdd->query($sql);

      return $result;
    }

    // Méthode retrieve
    public function retrieve($condition="")
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM categoriestickets WHERE " . $condition;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetchAll();
      // On renseigne les attributs
      $this->_catt_id = $data[0]['IDCATEGORIETICKET'];
      $this->_catt_name = $data[0]['NOMCATEGORIETICKET'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO categoriestickets (NOMCATEGORIETICKET) VALUES ('" . $this->_catt_name . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM categoriestickets WHERE '" . $this->_catt_id . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_catt_id;
    }

    public function get_name()
    {
      return $this->_catt_name;
    }
  }

?>

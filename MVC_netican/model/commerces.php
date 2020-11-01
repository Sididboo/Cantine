<?php

  include_once 'accesBDD.php';

  class Commerces
  {

    // Attributs
    private $_comm_id;
    private $_comm_nom;

    // Constructeur
    public function __construct($id = "", $nom = "")
    {
      $this->_comm_id = $id;
      $this->_comm_nom = $nom;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listCommerces = array();

      // Requête SQL
      $sql = "SELECT * FROM commerces ORDER BY NOMCOMMERCE";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $leCommerce = new Commerces($row['IDCOMMERCE'], $row['NOMCOMMERCE']);
        array_push($listCommerces, $leCommerce);
      }

      return $listCommerces;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM commerces WHERE IDCOMMERCE='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();
      // On renseigne les attributs
      $this->_comm_id = $data['IDCOMMERCE'];
      $this->_comm_nom = $data['NOMCOMMERCE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO commerces (NOMCOMMERCE) VALUES ('" . $this->_comm_nom . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM commerces WHERE IDCOMMERCE='" . $this->_comm_id . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_comm_id;
    }

    public function get_nom()
    {
      return $this->_comm_nom;
    }
  }

?>

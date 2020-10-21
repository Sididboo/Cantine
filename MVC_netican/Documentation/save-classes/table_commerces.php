<?php

  include_once '../server/accesBDD.php';

  class Commerces
  {

    // Attributs
    private $_comm_id;
    private $_comm_name;

    // Constructeur
    public function __construct($id = "", $name = "")
    {
      $this->_comm_id = $id;
      $this->_comm_name = $name;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM commerces";
      // On execute la requête
      $result = $bdd->query($sql);

      return $result;
    }

    // Méthode retrieve
    public function retrieve($condition = "")
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM commerces WHERE " . $condition;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetchAll();
      // On renseigne les attributs
      $this->_comm_id = $data[0]['IDCOMMERCE'];
      $this->_comm_name = $data[0]['NOMCOMMERCE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO commerces (NOMCOMMERCE) VALUES ('" . $this->_comm_name . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM commerces WHERE '" . $this->_comm_id . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_comm_id;
    }

    public function get_name()
    {
      return $this->_comm_name;
    }
  }

?>

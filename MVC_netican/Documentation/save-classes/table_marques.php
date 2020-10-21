<?php

  include_once '../server/accesBDD.php';

  class Marques
  {

    // Attributs
    private $_marq_id;
    private $_marq_name;

    // Constructeur
    public function __construct($id="", $name="")
    {
      $this->_marq_id = $id;
      $this->_marq_name = $name;
    }

    // Méthode findAll()
    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM marques";
      // La méthode prepare() permet de préparer la requête sql à être exécutée
      $result = $bdd->prepare($sql);
      // On execute la requête
      $result->execute();

      // Traitements
      while ($row = $result->fetch())
      {
        echo '<option value="'.$row['IDMARQUE'].'">'.$row['MARQUE'].'</option>';
      }
    }

    // Méthode retrieve
    public function retrieve($condition="")
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM marques WHERE ".$condition;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetchAll();

      // Traitements
      $this->_marq_id = $data[0]['IDMARQUE'];
      $this->_marq_name = $data[0]['MARQUE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO marques (MARQUE) VALUES ('" . $this->_marq_name . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM marques WHERE '" . $this->_marq_name . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_marq_id;
    }

    public function get_name()
    {
      return $this->_marq_name;
    }

  }

?>

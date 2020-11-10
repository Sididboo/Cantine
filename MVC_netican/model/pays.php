<?php

  include_once 'accesBDD.php';

  class Pays
  {

    // Attributs
    private $_pays_id;
    private $_pays_nom;

    // Constructeur
    public function __construct($id="", $nom="")
    {
      $this->_pays_id = $id;
      $this->_pays_nom = $nom;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listPays = array();

      // Requête SQL
      $sql = "SELECT * FROM pays";
      // On execute la requête
      $result = $bdd->query($sql);

      // Traitements
      while ($row = $result->fetch())
      {
        $lePays = new Pays($row['IDPAYS'], $row['PAYS']);
        array_push($listPays, $lePays);
      }

      return $listPays;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM pays WHERE IDPAYS='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_pays_id = $data['IDPAYS'];
      $this->_pays_nom = $data['PAYS'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO pays (PAYS) VALUES ('".$this->_pays_nom ."')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM pays WHERE IDPAYS='".$this->_pays_nom."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_pays_id;
    }

    public function get_nom()
    {
      return $this->_pays_nom;
    }

  }

?>

<?php

  include_once '../server/accesBDD.php';

  class Contient
  {
    // Attributs
    private $_cont_dateMenu;
    private $_cont_idPlat;

    // Constructeur
    function __construct($dateMenu="", $idPlat="")
    {
      $this->_cont_dateMenu = $dateMenu;
      $this->_cont_idPlat = $idPlat;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM contient";
      // On execute la requête
      $result = $bdd->query($sql);

      return $result;
    }

    // Méthode retrieve
    public function retrieve($condition="")
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM contient WHERE ".$condition;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_cont_dateMenu = $data['DATEMENU'];
      $this->_cont_idPlat = $data['IDPLAT'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO contient VALUES ('".$this->_cont_dateMenu."','".$this->_cont_idPlat."')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM contient WHERE DATEMENU='".$this->_cont_dateMenu."' AND IDPLAT='".$this->_cont_idPlat."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_dateMenu()
    {
      return $this->_cont_dateMenu;
    }

    public function get_idPlat()
    {
      return $this->_cont_idPlat;
    }
  }

?>

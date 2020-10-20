<?php

  include_once '../server/accesBDD.php';

  class Menus
  {
    // Attributs
    private $_menu_dateMenu;
    private $_menu_nbConvive;

    // Constructeur
    function __construct($dateMenu="", $nbConvive="")
    {
      $this->_menu_dateMenu = $dateMenu;
      $this->_menu_nbConvive = $nbConvive;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM menus";
      // On execute la requête
      $result = $bdd->query($sql);

      return $result;
    }

    // Méthode retrieve
    public function retrieve($condition="")
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM menus WHERE ".$condition;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_menu_dateMenu = $data['DATEMENU'];
      $this->_menu_nbConvive = $data['NBCONVIVE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO menus VALUES ('".$this->_menu_dateMenu."','".$this->_menu_nbConvive."')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM menu WHERE '".$this->_menu_dateMenu."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_dateMenu()
    {
      return $this->_menu_dateMenu;
    }

    public function get_nbConvive()
    {
      return $this->_menu_nbConvive;
    }
  }

?>

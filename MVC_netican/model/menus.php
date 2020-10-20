<?php

  include_once '../server/accesBDD.php';

  class Menus
  {
    // Attributs
    private $_menu_dateMenu;
    private $_menu_nbConvive;
    private $_menu_lesContenants = array();
    private $_menu_lesBesoins = array();

    // Constructeur
    function __construct($dateMenu="", $nbConvive="")
    {
      $this->_menu_dateMenu = $dateMenu;
      $this->_menu_nbConvive = $nbConvive;
      $this->_menu_lesContenants = array();
      $this->_menu_lesBesoins = array();
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listMenus = array();

      // Requête SQL
      $sql = "SELECT * FROM menus";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $leMenu = new Menus($row['DATEMENU'], $row['NBCONVIVE']);
        array_push($listMenus, $leMenu);
      }

      return $listMenus;
    }

    // Méthode retrieve
    public function retrieve($dateMenu)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM menus WHERE DATEMENU='".$dateMenu."'";
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
      $sql = "DELETE FROM menu WHERE DATEMENU='".$this->_menu_dateMenu."'";
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

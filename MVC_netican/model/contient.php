<?php

  include_once 'accesBDD.php';

  include_once 'menus.php';
  include_once 'plats.php';

  class Contient
  {
    // Attributs
    private $_cont_leMenu;
    private $_cont_lePlat;

    // Constructeur
    function __construct($leMenu=null, $lePlat=null)
    {
      $this->_cont_leMenu = $leMenu;
      $this->_cont_lePlat = $lePlat;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listContient = array();

      // Requête SQL
      $sql = "SELECT * FROM contient";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $leMenu = new Menus();
        $leMenu->retrieve($row['DATEMENU']);

        $lePlat = new Plats();
        $lePlat->retrieve($row['IDPLAT']);

        $leContenant = new Contient($leMenu, $lePlat);
        array_push($listContient, $leContenant);
      }

      return $listContient;
    }

    // Méthode findAll
    public function findAllByDate($date)
    {
      $bdd = BDD::getBDD();

      $listContient = array();

      // On execute la requête
      $result = $bdd->prepare('SELECT * FROM contient WHERE DATEMENU = ?');
      $result->execute(array($date));

      while ($row = $result->fetch()) 
      {
        $leMenu = new Menus();
        $leMenu->retrieve($row['DATEMENU']);

        $lePlat = new Plats();
        $lePlat->retrieve($row['IDPLAT']);

        $leContenant = new Contient($leMenu, $lePlat);
        array_push($listContient, $leContenant);
      }

      return $listContient;
    }

    //Méthode FindAllByDateMenu
    public function findAllByDateMenu($dateMenu)
    {
      $bdd = BDD::getBDD();

      $listContient = array();

      // Requête SQL
      $sql = 'SELECT * FROM contient WHERE DATEMENU ="'.$dateMenu.'"';
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $leMenu = new Menus();
        $leMenu->retrieve($row['DATEMENU']);

        $lePlat = new Plats();
        $lePlat->retrieve($row['IDPLAT']);

        $leContenant = new Contient($leMenu, $lePlat);
        array_push($listContient, $leContenant);
      }

      return $listContient;
    }
    // Méthode retrieve
    public function retrieve($dateMenu, $idPlat)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM contient WHERE DATEMENU='".$dateMenu."' AND IDPLAT='".$idPlat."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      $leMenu = new Menus();
      $leMenu->retrieve($data['DATEMENU']);

      $lePlat = new Plats();
      $lePlat->retrieve($data['IDPLAT']);

      $this->_cont_leMenu = $leMenu;
      $this->_cont_lePlat = $lePlat;
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = 'INSERT INTO contient VALUES ("'.$this->_cont_leMenu->get_dateMenu().'","'.$this->_cont_lePlat->get_id().'")';
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = 'DELETE FROM contient WHERE DATEMENU="'.$this->_cont_leMenu->get_dateMenu().'" AND IDPLAT="'.$this->_cont_lePlat->get_id().'"';
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_leMenu()
    {
      return $this->_cont_leMenu;
    }

    public function get_lePlat()
    {
      return $this->_cont_lePlat;
    }
  }

?>

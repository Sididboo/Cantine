<?php

  include_once 'accesBDD.php';

  include_once 'menus.php';
  include_once 'plats.php';
  include_once 'produitsAchetes.php';

  class Besoin
  {
    // Attributs
    private $_beso_leProduitAchete;
    private $_beso_lePlat;
    private $_beso_leMenu;
    private $_beso_quantite;

    // Constructeur
    function __construct($leProduitAchete=null, $lePlat=null, $leMenu=null, $quantite="")
    {
      $this->_beso_leProduitAchete = $leProduitAchete;
      $this->_beso_lePlat = $lePlat;
      $this->_beso_leMenu = $leMenu;
      $this->_beso_quantite = $quantite;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listBesoins = array();

      // Requête SQL
      $sql = "SELECT * FROM besoin";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch())
      {
        $leProduitAchete = new ProduitsAchetes();
        $leProduitAchete->retrieve($row['IDPRODUITACHETE']);

        $lePlat = new Plats();
        $lePlat->retrieve($row['IDPLAT']);

        $leMenu = new Menus();
        $leMenu->retrieve($row['DATEMENU']);

        $leBesoin = new Besoin($leProduitAchete, $lePlat, $leMenu, $row['QUANTITE']);
        array_push($listBesoins, $leBesoin);
      }

      return $listBesoins;
    }

    // Méthode retrieve
    public function retrieve($idProduitAchete, $idPlat, $dateMenu)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM besoin WHERE IDPRODUITACHETE='".$idProduitAchete."' AND IDPLAT='".$idPlat."' AND DATEMENU='".$dateMenu."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      $leProduitAchete = new ProduitsAchetes();
      $leProduitAchete->retrieve($data['IDPRODUITACHETE']);

      $lePlat = new Plats();
      $lePlat->retrieve($data['IDPLAT']);

      $leMenu = new Menus();
      $leMenu->retrieve($data['DATEMENU']);

      // Traitements
      $this->_beso_leProduitAchete = $leProduitAchete;
      $this->_beso_lePlat = $lePlat;
      $this->_beso_leMenu = $leMenu;
      $this->_beso_quantite = $data['QUANTITE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO besoin (IDPRODUITACHETE, IDPLAT, DATEMENU, QUANTITE) VALUES ('" . $this->_beso_leProduitAchete->get_id() . "','".$this->_beso_lePlat->get_id()."','".$this->_beso_leMenu->get_dateMenu()."','".$this->_beso_quantite."')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM besoin WHERE IDPRODUITACHETE='".$this->_beso_leProduitAchete->get_id()."' AND IDPLAT='".$this->_beso_lePlat->get_id()."' AND DATEMENU='".$this->_beso_leMenu->get_dateMenu()."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function findBesoins()
    {
      $bdd = BDD::getBDD();

      $listMenus = array();

      // Requête SQL
      $sql = "SELECT * FROM besoin;";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      while ($row = $result->fetch())
      {
        $leMenu = new Menus();
        $leMenu->retrieve($row['DATEMENU']);

        $lePlat = new Plats();
        $lePlat->retrieve($data['IDPLAT']);

        $leBesoin = new Besoin($lePlat, $leMenu);
        array_push($listMenus, $leBesoin);
      }

    return $listMenus;
    }

    public function get_leProduitAchete()
    {
      return $this->_beso_leProduitAchete;
    }

    public function get_lePlat()
    {
      return $this->_beso_lePlat;
    }

    public function get_leMenu()
    {
      return $this->_beso_leMenu;
    }

    public function get_quantite()
    {
      return $this->_beso_quantite;
    }

    //Pour le findBesoins() :
    //WHERE IDPLAT='".$idPlat."' AND DATEMENU='".$dateMenu."'
  }

?>

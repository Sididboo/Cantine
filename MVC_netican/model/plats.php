<?php

  include_once 'accesBDD.php';

  include_once 'categoriesPlats.php';

  class Plats
  {
    // Attributs
    private $_plat_id;
    private $_plat_laCategorie;
    private $_plat_nom;
    private $_plat_nbPersonne;
    private $_plat_lesUtilisations = array();
    private $_plat_lesBesoins = array();
    private $_plat_lesContenants = array();

    // Constructeur
    function __construct($id="", $laCategorie=null, $nom="", $nbPersonne="")
    {
      $this->_plat_id = $id;
      $this->_plat_laCategorie = $laCategorie;
      $this->_plat_nom = $nom;
      $this->_plat_nbPersonne = $nbPersonne;
      $this->_plat_lesUtilisations = array();
      $this->_plat_lesBesoins = array();
      $this->_plat_lesContenants = array();
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listPlats = array();

      // Requête SQL
      $sql = "SELECT * FROM plats";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch())
      {
        $laCategorie = new CategoriesPlats();
        $laCategorie->retrieve($row['IDCATEGORIEPLAT']);

        $lePLat = new Plats($row['IDPLAT'], $laCategorie, $row['NOMPLAT'], $row['NBPERSONNE']);
        array_push($listPlats, $lePLat);
      }

      return $listPlats;
    }

     // Méthode findAllByCat
     public function findAllByCat($categorie)
     {
       $bdd = BDD::getBDD();
 
       $listPlats = array();
 
       // Requête SQL
       $sql = "SELECT * FROM plats WHERE IDCATEGORIEPLAT = '". $categorie ."' ORDER BY NOMPLAT";
       // On execute la requête
       $result = $bdd->query($sql);
 
       while ($row = $result->fetch())
       {
         $laCategorie = new CategoriesPlats();
         $laCategorie->retrieve($row['IDCATEGORIEPLAT']);
 
         $lePLat = new Plats($row['IDPLAT'], $laCategorie, $row['NOMPLAT'], $row['NBPERSONNE']);
         array_push($listPlats, $lePLat);
       }
 
       return $listPlats;
     }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM plats WHERE IDPLAT=".$id;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      $laCategorie = new CategoriesPlats();
      $laCategorie->retrieve($data['IDCATEGORIEPLAT']);

      // Traitements
      $this->_plat_idPlat = $data['IDPLAT'];
      $this->_plat_laCategorie = $laCategorie;
      $this->_plat_nom = $data['NOMPLAT'];
      $this->_plat_nbPersonne = $data['NBPERSONNE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO plats (IDCATEGORIEPLAT, NOMPLAT, NBPERSONNE) VALUES ('" . $this->_plat_laCategorie->get_id() . "','".$this->_plat_nom."','".$this->_plat_nbPersonne."')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM plats WHERE IDPLAT='".$this->_plat_id."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_plat_id;
    }

    public function get_laCategorie()
    {
      return $this->_plat_laCategorie;
    }

    public function get_nom()
    {
      return $this->_plat_nom;
    }

    public function get_nbPersonne()
    {
      return $this->_plat_nbPersonne;
    }
  }

?>

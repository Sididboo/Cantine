<?php

  include_once '../server/accesBDD.php';

  class Plats
  {
    // Attributs
    private $_plat_idPlat;
    private $_plat_idCategoriePlat;
    private $_plat_nomPlat;
    private $_plat_nbPersonne;

    // Constructeur
    function __construct($idPlat="", $idCategoriePlat="", $nomPlat="", $nbPersonne="")
    {
      $this->_plat_idPlat = $idPlat;
      $this->_plat_idCategoriePlat = $idCategoriePlat;
      $this->_plat_nomPlat = $nomPlat;
      $this->_plat_nbPersonne = $nbPersonne;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM plats";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch())
      {
        echo '<option value="'.$row['IDPLAT'].'">'.$row['NOMPLAT'].'</option>';
      }
    }

    // Méthode findAll
    public function findAllCondition($condition="")
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM plats WHERE ".$condition;
      // On execute la requête
      $result = $bdd->query($sql);

      return $result;
    }

    // Méthode retrieve
    public function retrieve($condition="")
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM plats WHERE ".$condition;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_plat_idPlat = $data['IDPLAT'];
      $this->_plat_idCategoriePlat = $data['IDCATEGORIEPLAT'];
      $this->_plat_nomPlat = $data['NOMPLAT'];
      $this->_plat_nbPersonne = $data['NBPERSONNE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO plats (IDCATEGORIEPLAT, NOMPLAT, NBPERSONNE) VALUES ('".$this->_plat_idCategoriePlat."','".$this->_plat_nomPlat."','".$this->_plat_nbPersonne."')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM plats WHERE IDPLAT='".$this->_plat_idPlat."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_idPlat()
    {
      return $this->_plat_idPlat;
    }

    public function get_idCategoriePlat()
    {
      return $this->_plat_idCategoriePlat;
    }

    public function get_nomPlat()
    {
      return $this->_plat_nomPlat;
    }

    public function get_nbPersonne()
    {
      return $this->_plat_nbPersonne;
    }
  }

?>

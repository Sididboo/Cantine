<?php

  include_once '../server/accesBDD.php';

  class CategoriesPlats
  {
    // Attributs
    private $_catp_idCategoriePlat;
    private $_catp_nomCategoriePlat;

    // Constructeur
    function __construct($idCategoriePlat="", $nomCategoriePlat="")
    {
      $this->_catp_idCategoriePlat = $idCategoriePlat;
      $this->_catp_nomCategoriePlat = $nomCategoriePlat;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM categoriesplats";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch())
      {
        echo '<option value="'.$row['IDCATEGORIEPLAT'].'">'.$row['NOMCATEGORIEPLAT'].'</option>';
      }
    }

    // Méthode retrieve
    public function retrieve($condition="")
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM categoriesplats WHERE ".$condition;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_catp_idCategoriePlat = $data['IDCATEGORIEPLAT'];
      $this->_catp_nomCategoriePlat = $data['NOMCATEGORIEPLAT'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO categoriesplats (NOMCATEGORIEPLAT) VALUES ('".$this->_catp_nomCategoriePlat."')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM categoriesplats WHERE IDCATEGORIEPLAT='".$this->_catp_idCategoriePlat."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Getters
    public function get_idCategoriePlat()
    {
      return $this->_catp_idCategoriePlat;
    }

    public function get_nomCategoriePlat()
    {
      return $this->_catp_nomCategoriePlat;
    }
  }

?>

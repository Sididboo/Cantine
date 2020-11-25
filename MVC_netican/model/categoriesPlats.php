<?php

  include_once 'accesBDD.php';

  class CategoriesPlats
  {
    // Attributs
    private $_catp_id;
    private $_catp_nom;

    // Constructeur
    function __construct($id=0, $nom="")
    {
      $this->_catp_id = $id;
      $this->_catp_nom = $nom;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listCategoriesPlats = array();

      // Requête SQL
      $sql = "SELECT * FROM categoriesplats";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch())
      {
        $laCategorie = new CategoriesPlats($row['IDCATEGORIEPLAT'], $row['NOMCATEGORIEPLAT']);
        array_push($listCategoriesPlats, $laCategorie);
      }

      return $listCategoriesPlats;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM categoriesplats WHERE IDCATEGORIEPLAT='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_catp_id = $data['IDCATEGORIEPLAT'];
      $this->_catp_nom = $data['NOMCATEGORIEPLAT'];
    }
      // Méthode retrieveByName
      public function retrieveByName($name)
      {
        $bdd = BDD::getBDD();
        // Requête SQL
        $sql = "SELECT * FROM categoriesplats WHERE NOMCATEGORIEPLAT='".$name."'";
        // On execute la requête
        $result = $bdd->query($sql);
        // On récupère les données dans un tableau
        $data = $result->fetch();
        // On renseigne les attributs
        $this->_catt_id = $data['IDCATEGORIEPLAT'];
        $this->_catt_nom = $data['NOMCATEGORIEPLAT'];
      }
    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO categoriesplats (NOMCATEGORIEPLAT) VALUES ('".$this->_catp_nom."')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM categoriesplats WHERE IDCATEGORIEPLAT='".$this->_catp_id."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Getters
    public function get_id()
    {
      return $this->_catp_id;
    }

    public function get_nom()
    {
      return $this->_catp_nom;
    }
  }

?>

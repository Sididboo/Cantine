<?php

  include_once 'accesBDD.php';

  class Marques
  {

    // Attributs
    private $_marq_id;
    private $_marq_nom;

    // Constructeur
    public function __construct($id=0, $nom="")
    {
      $this->_marq_id = $id;
      $this->_marq_nom = $nom;
    }

    // Méthode findAll()
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listMarques = array();

      // Requête SQL
      $sql = "SELECT * FROM marques";
      // On execute la requête
      $result = $bdd->query($sql);

      // Traitements
      while ($row = $result->fetch())
      {
        $laMarque = new Marques();
        $laMarque->retrieve($row['IDMARQUE']);

        array_push($listMarques, $laMarque);
      }

      return $listMarques;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM marques WHERE IDMARQUE='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup le résultat dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_marq_id = $data['IDMARQUE'];
      $this->_marq_nom = $data['MARQUE'];
    }

    // Méthode retrieveLast
    public function retrieveLast()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT *
              FROM marques 
              ORDER BY IDMARQUE DESC LIMIT 1";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup le résultat dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_marq_id = $data['IDMARQUE'];
      $this->_marq_nom = $data['MARQUE'];
    }

    // Méthode retrieveByName
    public function retrieveByName($name)
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM marques WHERE UCASE(MARQUE)='".$name."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetch();
      // On renseigne les attributs
      $this->_marq_id = $data['IDMARQUE'];
      $this->_marq_nom = $data['MARQUE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO marques (MARQUE) VALUES ('" . $this->_marq_nom . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM marques WHERE IDMARQUE='" . $this->_marq_id . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_marq_id;
    }

    public function get_nom()
    {
      return $this->_marq_nom;
    }

  }

?>

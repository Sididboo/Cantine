<?php

  include_once './server/accesBDD.php';

  class Unites
  {

    // Attributs
    private $_unit_id;
    private $_unit_nom;

    // Constructeur
    public function __construct($id="", $nom="")
    {
      $this->_unit_id = $id;
      $this->_unit_nom = $nom;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listUnites = array();

      // Requête SQL
      $sql = "SELECT * FROM unites";
      // On execute la methode
      $result = $bdd->query($sql);

      // Traitements
      while ($row = $result->fetch())
      {
        $unite = new Unites($row['IDUNITE'], $row['UNITE']);
        array_push($listUnites, $unite);
      }

      return $listUnites;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM unites WHERE IDUNITE = '".$id."' ";
      $result = $bdd->query($sql);

      // On récup le résultat dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_unit_id = $data['IDUNITE'];
      $this->_unit_nom = $data['UNITE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO unites (UNITE) VALUES ('" . $this->_unit_nom . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM unites WHERE '" . $this->_unit_nom . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_unit_id;
    }

    public function get_nom()
    {
      return $this->_unit_nom;
    }

  }

?>

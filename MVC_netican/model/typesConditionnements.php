<?php

  include_once './server/accesBDD.php';

  class TypesConditionnements
  {

    // Attributs
    private $_tyCo_id;
    private $_tyCo_nom;

    // Constructeur
    public function __construct($id="", $nom="")
    {
      $this->_tyCo_id = $id;
      $this->_tyCo_nom = $nom;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listTypesConditionnements = array();

      // Requête SQL
      $sql = "SELECT * FROM typesconditionnements";
      // On execute la requête
      $result = $bdd->query($sql);

      // Traitements
      while ($row = $result->fetch())
      {
        $leTypeConditionnement = new TypesConditionnements($row['IDTYPECONDITIONNEMENT'], $row['TYPECONDITIONNEMENT']);
        array_push($listTypesConditionnements, $leTypeConditionnement);
      }

      return $listTypesConditionnements;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM typesconditionnements WHERE IDTYPECONDITIONNEMENT='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récup les résultats dans un tableau
      $data = $result->fetch();

      // Traitements
      $this->_tyCo_id = $data['IDTYPECONDITIONNEMENT'];
      $this->_tyCo_nom = $data['TYPECONDITIONNEMENT'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO typesconditionnements (TYPECONDITIONNEMENT) VALUES ('" . $this->_tyCo_nom . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM typesconditionnements WHERE IDTYPECONDITIONNEMENT='".$this->_tyCo_nom."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_tyCo_id;
    }

    public function get_nom()
    {
      return $this->_tyCo_nom;
    }

  }

?>

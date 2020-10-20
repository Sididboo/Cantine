<?php

  include_once '../server/accesBDD.php';

  class Unites
  {

    // Attributs
    private $_unit_id;
    private $_unit_name;

    // Constructeur
    public function __construct($id="", $name="")
    {
      $this->_unit_id = $id;
      $this->_unit_name = $name;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM unites";
      // La méthode prepare() permet de préparer la requête sql à être exécutée
      $result = $bdd->prepare($sql);
      // On execute la requête
      $result->execute();

      // Traitements
      while ($row = $result->fetch())
      {
        echo '<option value="'.$row['IDUNITE'].'">'.$row['UNITE'].'</option>';
      }
    }

    // Méthode retrieve
    public function retrieve($id="", $name="")
    {
      $bdd = BDD::getBDD();

      if ($id != "")
      {
        // Requête SQL
        $sql = "SELECT * FROM unites WHERE IDUNITE = '$id' ";
        // La méthode prepare() permet de préparer la requête sql à être exécutée
        $result = $bdd->prepare($sql);
        // On execute la requête
        $result->execute();
        // On récup les résultats dans un tableau
        $data = $result->fetchAll();

        // Traitements
        $this->_unit_id = $data[0]['IDUNITE'];
        $this->_unit_name = $data[0]['UNITE'];
      }
        else
        {
          // Requête SQL
          $sql = "SELECT * FROM unites WHERE UNITE = '$name' ";
          // La méthode prepare() permet de préparer la requête sql à être exécutée
          $result = $bdd->prepare($sql);
          // On execute la requête
          $result->execute();
          // On récup les résultats dans un tableau
          $data = $result->fetchAll();

          // Traitements
          $this->_unit_id = $data[0]['IDUNITE'];
          $this->_unit_name = $data[0]['UNITE'];
        }
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO unites (UNITE) VALUES ('" . $this->_unit_name . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM unites WHERE '" . $this->_unit_name . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_unit_id;
    }

    public function get_name()
    {
      return $this->_unit_name;
    }

  }

?>

<?php

  include_once '../server/accesBDD.php';

  class Pays
  {

    // Attributs
    private $_pays_id;
    private $_pays_name;

    // Constructeur
    public function __construct($id="", $name="")
    {
      $this->_pays_id = $id;
      $this->_pays_name = $name;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM pays";
      // La méthode prepare() permet de préparer la requête sql à être exécutée
      $result = $bdd->prepare($sql);
      // On execute la requête
      $result->execute();

      // Traitements
      while ($row = $result->fetch())
      {
        if ($row['PAYS'] == 'France')
        {
          echo '<option value="'.$row['IDPAYS'].'" selected>'.$row['PAYS'].'</option>';
        }
        else
        {
          echo '<option value="'.$row['IDPAYS'].'">'.$row['PAYS'].'</option>';
        }
      }
    }

    // Méthode retrieve
    public function retrieve($id="", $name="")
    {
      $bdd = BDD::getBDD();

      if ($id != "")
      {
        // Requête SQL
        $sql = "SELECT * FROM pays WHERE IDPAYS = '$id' ";
        // La méthode prepare() permet de préparer la requête sql à être exécutée
        $result = $bdd->prepare($sql);
        // On execute la requête
        $result->execute();
        // On récup les résultats dans un tableau
        $data = $result->fetchAll();

        // Traitements
        $this->_pays_id = $data[0]['IDPAYS'];
        $this->_pays_name = $data[0]['PAYS'];
      }
        else
        {
          // Requête SQL
          $sql = "SELECT * FROM pays WHERE PAYS = '$name' ";
          // La méthode prepare() permet de préparer la requête sql à être exécutée
          $result = $bdd->prepare($sql);
          // On execute la requête
          $result->execute();
          // On récup les résultats dans un tableau
          $data = $result->fetchAll();

          // Traitements
          $this->_pays_id = $data[0]['IDPAYS'];
          $this->_pays_name = $data[0]['PAYS'];
        }
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO pays (PAYS) VALUES ('" . $this->_pays_name . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM pays WHERE '" . $this->_pays_name . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_pays_id;
    }

    public function get_name()
    {
      return $this->_pays_name;
    }

  }

?>

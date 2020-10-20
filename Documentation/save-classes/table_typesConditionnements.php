<?php

  include_once '../server/accesBDD.php';

  class TypesConditionnements
  {

    // Attributs
    private $_tyCo_id;
    private $_tyCo_name;

    // Constructeur
    public function __construct($id="", $name="")
    {
      $this->_tyCo_id = $id;
      $this->_tyCo_name = $name;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM typesconditionnements";
      // La méthode prepare() permet de préparer la requête sql à être exécutée
      $result = $bdd->prepare($sql);
      // On execute la requête
      $result->execute();

      // Traitements
      while ($row = $result->fetch())
      {
        echo '<option value="'.$row['IDTYPECONDITIONNEMENT'].'">'.$row['TYPECONDITIONNEMENT'].'</option>';
      }
    }

    // Méthode retrieve
    public function retrieve($id="", $name="")
    {
      $bdd = BDD::getBDD();

      if ($id != "")
      {
        // Requête SQL
        $sql = "SELECT * FROM typesconditionnements WHERE IDTYPECONDITIONNEMENT = '$id' ";
        // La méthode prepare() permet de préparer la requête sql à être exécutée
        $result = $bdd->prepare($sql);
        // On execute la requête
        $result->execute();
        // On récup les résultats dans un tableau
        $data = $result->fetchAll();

        // Traitements
        $this->_tyCo_id = $data[0]['IDTYPECONDITIONNEMENT'];
        $this->_tyCo_name = $data[0]['TYPECONDITIONNEMENT'];
      }
        else
        {
          // Requête SQL
          $sql = "SELECT * FROM typesconditionnements WHERE TYPECONDITIONNEMENT = '$name' ";
          // La méthode prepare() permet de préparer la requête sql à être exécutée
          $result = $bdd->prepare($sql);
          // On execute la requête
          $result->execute();
          // On récup les résultats dans un tableau
          $data = $result->fetchAll();

          // Traitements
          $this->_tyCo_id = $data[0]['IDTYPECONDITIONNEMENT'];
          $this->_tyCo_name = $data[0]['TYPECONDITIONNEMENT'];
        }
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO typesconditionnements (TYPECONDITIONNEMENT) VALUES ('" . $this->_tyCo_name . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM typesconditionnements WHERE '" . $this->_tyCo_name . "' ";
      // On execute la requête
      $bdd->exec($sql);
    }

    public function get_id()
    {
      return $this->_tyCo_id;
    }

    public function get_name()
    {
      return $this->_tyCo_name;
    }

  }

?>

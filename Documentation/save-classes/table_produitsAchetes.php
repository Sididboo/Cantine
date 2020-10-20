<?php

  include_once '../server/accesBDD.php';

  class ProduitsAchetes
  {

    // Attributs
    private $_proa_id;
    private $_proa_idTicket;
    private $_proa_idProduit;
    private $_proa_dateAchat;
    private $_proa_datePeremption;
    private $_proa_dateOuverture;
    private $_proa_reste;


    // Constructeur
    public function __construct($id="", $idTicket="", $idProduit="", $dateAchat="", $datePeremption="", $dateOuverture="", $reste="")
    {
      $this->_proa_id = $id;
      $this->_proa_idTicket = $idTicket;
      $this->_proa_idProduit = $idProduit;
      $this->_proa_dateAchat = $dateAchat;
      $this->_proa_datePeremption = $datePeremption;
      $this->_proa_dateOuverture = $dateOuverture;
      $this->_proa_reste = $reste;
    }

    // Méthode findAll
    public function findAll($condition="")
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM produitsachetes WHERE ".$condition;
      // On execute la requête
      $result = $bdd->query($sql);

      return $result;
    }

    // Méthode retrieve
    public function retrieve($condition="")
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM produitsachetes WHERE ".$condition;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetchAll();

      if (!empty($data))
      {
        $this->_proa_id = $data[0]['IDPRODUITACHETE'];
        $this->_proa_idTicket = $data[0]['IDTICKET'];
        $this->_proa_idProduit = $data[0]['IDPRODUIT'];
        $this->_proa_dateAchat = $data[0]['DATEACHAT'];
        $this->_proa_datePeremption = $data[0]['DATEPEREMPTION'];
        $this->_proa_dateOuverture = $data[0]['DATEOUVERTURE'];
        $this->_proa_reste = $data[0]['RESTE'];
      }
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO produitsachetes (IDTICKET, IDPRODUIT, DATEACHAT, DATEPEREMPTION)
        VALUES ('" . $this->_proa_idTicket . "', '" . $this->_proa_idProduit . "', '" . $this->_proa_dateAchat . "', '" . $this->_proa_datePeremption . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete($condition="")
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM produitsachetes WHERE ".$condition;
      // On execute la requête
      $bdd->exec($sql);
    }

    // Getters
    public function get_id()
    {
      return $this->_proa_id;
    }

    public function get_idTicket()
    {
      return $this->_proa_idTicket;
    }

    public function get_idProduit()
    {
      return $this->_proa_idProduit;
    }

    public function get_dateAchat()
    {
      return $this->_proa_dateAchat;
    }

    public function get_datePeremption()
    {
      return $this->_proa_datePeremption;
    }

    public function get_dateOuverture()
    {
      return $this->_proa_dateOuverture;
    }

    public function get_reste()
    {
      return $this->_proa_reste;
    }

  }

?>

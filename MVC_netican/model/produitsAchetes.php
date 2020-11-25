<?php

  include_once 'accesBDD.php';

  include_once 'produits.php';
  include_once 'tickets.php';

  class ProduitsAchetes
  {

    // Attributs
    private $_proa_id;
    private $_proa_leTicket;
    private $_proa_leProduit;
    private $_proa_dateAchat;
    private $_proa_datePeremption;
    private $_proa_dateOuverture;
    private $_proa_reste;
    private $_proa_lesBesoins = array();

    // Constructeur
    public function __construct($id="", $leTicket=null, $leProduit=null, $dateAchat="", $datePeremption="", $dateOuverture="", $reste="")
    {
      $this->_proa_id = $id;
      $this->_proa_leTicket = $leTicket;
      $this->_proa_leProduit = $leProduit;
      $this->_proa_dateAchat = $dateAchat;
      $this->_proa_datePeremption = $datePeremption;
      $this->_proa_dateOuverture = $dateOuverture;
      $this->_proa_reste = $reste;
      $this->_proa_lesBesoins = array();
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listProduitsAchetes = array();

      // Requête SQL
      $sql = "SELECT IDTICKET, IDPRODUIT, DATEACHAT, DATEPEREMPTION, DATEOUVERTURE, RESTE, COUNT(IDPRODUITACHETE) AS NB 
              FROM produitsachetes 
              GROUP BY IDTICKET, IDPRODUIT, DATEACHAT, DATEPEREMPTION, DATEOUVERTURE, RESTE 
              ORDER BY IDPRODUITACHETE";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $leTicket = new Tickets();
        $leTicket->retrieve($row['IDTICKET']);

        $leProduit = new Produits();
        $leProduit->retrieve($row['IDPRODUIT']);

        $leProduitAchete = new ProduitsAchetes($row['IDPRODUITACHETE'], $leTicket, $leProduit, $row['DATEACHAT'], $row['DATEPEREMPTION'], $row['DATEOUVERTURE'], $row['RESTE']);
        
        $listProduitsAchetes[$leProduitAchete] = $row['NB'];
      }

      return $listProduitsAchetes;
    }

    public function findByTicket($idTicket)
    {
      $bdd = BDD::getBDD();

      $listProduitsAchetes = array();

      // Requête SQL
      $sql = "SELECT * FROM produitsachetes WHERE IDTICKET='".$idTicket."'";
      // On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $leTicket = new Tickets();
        $leTicket->retrieve($row['IDTICKET']);

        $leProduit = new Produits();
        $leProduit->retrieve($row['IDPRODUIT']);

        $leProduitAchete = new ProduitsAchetes($row['IDPRODUITACHETE'], $leTicket, $leProduit, $row['DATEACHAT'], $row['DATEPEREMPTION'], $row['DATEOUVERTURE'], $row['RESTE']);
        array_push($listProduitsAchetes, $leProduitAchete);
      }

      return $listProduitsAchetes;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM produitsachetes WHERE IDPRODUITACHETE='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetch();

      $leTicket = new Tickets();
      $leTicket->retrieve($data['IDTICKET']);

      $leProduit = new Produits();
      $leProduit->retrieve($data['IDPRODUIT']);

      $this->_proa_id = $data['IDPRODUITACHETE'];
      $this->_proa_leTicket = $leTicket;
      $this->_proa_leProduit = $leProduit;
      $this->_proa_dateAchat = $data['DATEACHAT'];
      $this->_proa_datePeremption = $data['DATEPEREMPTION'];
      $this->_proa_dateOuverture = $data['DATEOUVERTURE'];
      $this->_proa_reste = $data['RESTE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO produitsachetes (IDTICKET, IDPRODUIT, DATEACHAT, DATEPEREMPTION)
        VALUES ('" . $this->_proa_leTicket->get_id() . "', '" . $this->_proa_leProduit->get_id() . "', '" . $this->_proa_dateAchat . "', '" . $this->_proa_datePeremption . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM produitsachetes WHERE IDPRODUITACHETE='".$this->_proa_id."'";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Getters
    public function get_id()
    {
      return $this->_proa_id;
    }

    public function get_leTicket()
    {
      return $this->_proa_leTicket;
    }

    public function get_leProduit()
    {
      return $this->_proa_leProduit;
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

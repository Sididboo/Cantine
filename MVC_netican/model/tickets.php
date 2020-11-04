<?php

  include_once 'accesBDD.php';

  include_once 'categoriesTickets.php';
  include_once 'commerces.php';

  class Tickets
  {
    // Attributs
    private $_tick_id;
    private $_tick_laCategorie;
    private $_tick_leCommerce;
    private $_tick_dateTicket;
    private $_tick_pieceJointe;
    private $_tick_lesProduitsAchetes = array();

    // Constructeur
    public function __construct($id = "", $laCategorie = null, $leCommerce = null, $dateTicket = "", $pieceJointe = "")
    {
      $this->_tick_id = $id;
      $this->_tick_laCategorie = $laCategorie;
      $this->_tick_leCommerce = $leCommerce;
      $this->_tick_dateTicket = $dateTicket;
      $this->_tick_pieceJointe = $pieceJointe;
      $this->_tick_lesProduitsAchetes = array();
    }

    public function findAll()
    {
      $bdd = BDD::getBDD();

      $listTickets = array();

      // Requête SQL
      $sql = "SELECT * FROM tickets";

      //On execute la requête
      $result = $bdd->query($sql);

      while ($row = $result->fetch()) 
      {
        $laCategorie = new CategoriesTickets();
        $laCategorie->retrieve($row['IDCATEGORIETICKET']);

        $leCommerce = new Commerces();
        $leCommerce->retrieve($row['IDCOMMERCE']);

        $leTicket = new Tickets($row['IDTICKET'], $laCategorie, $leCommerce, $row['DATETICKET'], $row['PIECEJOINTE']);
        array_push($listTickets, $leTicket);
      }

      return $listTickets;
    }

    // Méthode retrieve
    public function retrieve($id)
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM tickets WHERE IDTICKET='".$id."'";
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetch();
      // On renseigne les attributs
      $laCategorie = new CategoriesTickets();
      $laCategorie->retrieve($data['IDCATEGORIETICKET']);

      $leCommerce = new Commerces();
      $leCommerce->retrieve($data['IDCOMMERCE']);

      $this->_tick_id = $data['IDTICKET'];
      $this->_tick_laCategorie = $laCategorie;
      $this->_tick_leCommerce = $leCommerce;
      $this->_tick_dateTicket = $data['DATETICKET'];
      $this->_tick_pieceJointe = $data['PIECEJOINTE'];
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO tickets (IDCATEGORIETICKET, IDCOMMERCE, DATETICKET, PIECEJOINTE)
        VALUES ('" . $this->_tick_laCategorie->get_id() . "', '" . $this->_tick_leCommerce->get_id() . "', '" . $this->_tick_dateTicket . "', '" . $this->_tick_pieceJointe . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode Delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM tickets WHERE IDTICKET='".$this->_tick_id."'";
      // Execution de la requête
      $bdd->exec($sql);
    }

    // Méthode Update
    public function update($pieceJointe)
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "UPDATE tickets SET PIECEJOINTE='".$pieceJointe."' WHERE IDTICKET='".$this->_tick_id."'";
      // Execution de la requête
      $result = $bdd->query($sql);
    }

    // Getter and Setter
    public function get_id()
    {
      return $this->_tick_id;
    }

    public function get_laCategorie()
    {
      return $this->_tick_laCategorie;
    }

    public function get_leCommerce()
    {
      return $this->_tick_leCommerce;
    }

    public function get_dateTicket()
    {
      return $this->_tick_dateTicket;
    }

    public function get_pieceJointe()
    {
      return $this->_tick_pieceJointe;
    }
  }
?>

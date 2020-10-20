<?php

  include_once './server/accesBDD.php';

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

    // Méthode de suppression du fichier
    public function fileDelete()
    {
      // Sélection du fichier à supprimer
      $path = "../images/" . $this->_tick_pieceJointe;

      // Suppresion du fichier
      unlink($path);
    }

    // Méthode Upload
    public function upload()
    {
      $target_dir = "../images/";
      $target_file = $target_dir . basename($_FILES["file"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Check if image file is a actual image or no
      if (isset($_POST["button_form_submit"]))
      {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check !== false)
        {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        }
        else
        {
          echo "File is not an image.";
          $uploadOk = 0;
        }
      }

      // Check if file already exists
      if (file_exists($target_file))
      {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["file"]["size"] > 500000)
      {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }

      // Allow certain file formats
      if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
      {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0)
      {
        echo "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
      }
      else
      {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
        {
          echo " The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
        }
        else
        {
          echo "Sorry, there was an error uploading your file.";
          $uploadOk = 0;
        }
      }
      return $uploadOk;
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

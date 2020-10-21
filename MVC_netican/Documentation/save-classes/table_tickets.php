<?php

  include_once '../server/accesBDD.php';

  class Tickets
  {
    // Attributs
    private $_tick_id;
    private $_tick_idCategorieTicket;
    private $_tick_idCommerce;
    private $_tick_dateTicket;
    private $_tick_pieceJointe;

    // Constructeur
    public function __construct($id = "", $idCategorieTicket = "", $idCommerce = "", $dateTicket = "", $pieceJointe = "")
    {
      $this->_tick_id = $id;
      $this->_tick_idCategorieTicket = $idCategorieTicket;
      $this->_tick_idCommerce = $idCommerce;
      $this->_tick_dateTicket = $dateTicket;
      $this->_tick_pieceJointe = $pieceJointe;
    }

    public function findAll()
    {
      $bdd = BDD::getBDD();

      // Requête SQL
      $sql = "SELECT * FROM tickets";

      //On execute la requête
      $result = $bdd->query($sql);

      return $result;
    }

    // Méthode retrieve
    public function retrieve($condition = "")
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM tickets WHERE " . $condition;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetchAll();
      // On renseigne les attributs
      $this->_tick_id = $data[0]['IDTICKET'];
      $this->_tick_idCategorieTicket = $data[0]['IDCATEGORIETICKET'];
      $this->_tick_idCommerce = $data[0]['IDCOMMERCE'];
      $this->_tick_dateTicket = $data[0]['DATETICKET'];
      // $this->_tick_pieceJointe = $data[0][''];03.0
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "INSERT INTO tickets (IDCOMMERCE, IDCATEGORIETICKET, DATETICKET, PIECEJOINTE)
        VALUES ('" . $this->_tick_idCommerce . "', '" . $this->_tick_idCategorieTicket . "', '" . $this->_tick_dateTicket . "', '" . $this->_tick_pieceJointe . "')";
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode Delete
    public function delete()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM tickets WHERE IDTICKET=" . $this->_tick_id;
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

    public function get_idCategorieTicket()
    {
      return $this->_tick_idCategorieTicket;
    }

    public function get_idCommerce()
    {
      return $this->_tick_idCommerce;
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

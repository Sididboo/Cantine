<?php

  include_once '../server/accesBDD.php';

  class Produits
  {
    // Attributs
    private $_prod_id;
    private $_prod_idPays;
    private $_prod_idMarque;
    private $_prod_idUnite;
    private $_prod_idTypeConditionnement;
    private $_prod_idIngredient;
    private $_prod_codeBarre;
    private $_prod_quantiteConditionnement;

    public function __construct($id="", $idPays="", $idMarque="", $idUnite="", $idTypeConditionnement="", $idIngredient="", $codeBarre="", $quantiteConditionnement="")
    {
      $this->_prod_id = $id;
      $this->_prod_idPays = $idPays;
      $this->_prod_idMarque = $idMarque;
      $this->_prod_idUnite = $idUnite;
      $this->_prod_idTypeConditionnement = $idTypeConditionnement;
      $this->_prod_idIngredient = $idIngredient;
      $this->_prod_codeBarre = $codeBarre;
      $this->_prod_quantiteConditionnement = $quantiteConditionnement;
    }

    // Méthode findAll
    public function findAll()
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "SELECT * FROM produits";
      // On execute la requête
      $result = $bdd->query($sql);

      return $result;
    }

    // Méthode retrieve
    public function retrieve($condition="")
    {
      $bdd = BDD::getBDD();

      // Requête
      $sql = "SELECT * FROM produits WHERE ".$condition;
      // On execute la requête
      $result = $bdd->query($sql);
      // On récupère les données dans un tableau
      $data = $result->fetchAll();

      $isAlreadyInsert = false;

      if (!empty($data))
      {
        $isAlreadyInsert = true;

        $this->_prod_id = $data[0]['IDPRODUIT'];
        $this->_prod_idPays = $data[0]['IDPAYS'];
        $this->_prod_idMarque = $data[0]['IDMARQUE'];
        $this->_prod_idUnite = $data[0]['IDUNITE'];
        $this->_prod_idTypeConditionnement = $data[0]['IDTYPECONDITIONNEMENT'];
        $this->_prod_idIngredient = $data[0]['IDINGREDIENT'];
        $this->_prod_codeBarre = $data[0]['CODEBARRE'];
        $this->_prod_quantiteConditionnement = $data[0]['QUANTITECONDITIONNEMENT'];
      }

      return $isAlreadyInsert;
    }

    // Méthode create
    public function create()
    {
      $bdd = BDD::getBDD();

      if (strlen($this->_prod_codeBarre) == 0)
      {
        if (strlen($this->_prod_idPays) == 0 && strlen($this->_prod_idMarque) > 0)
        {
          // Requête SQL
          $sql = "INSERT INTO produits (IDPAYS, IDMARQUE, IDUNITE, IDTYPECONDITIONNEMENT, IDINGREDIENT, CODEBARRE, QUANTITECONDITIONNEMENT)
            VALUES (NULL,'" . $this->_prod_idMarque . "','" . $this->_prod_idUnite . "','" . $this->_prod_idTypeConditionnement . "','" . $this->_prod_idIngredient . "',NULL,'" . $this->_prod_quantiteConditionnement . "')";
        }
          elseif (strlen($this->_prod_idPays) > 0 && strlen($this->_prod_idMarque) == 0)
          {
            // Requête SQL
            $sql = "INSERT INTO produits (IDPAYS, IDMARQUE, IDUNITE, IDTYPECONDITIONNEMENT, IDINGREDIENT, CODEBARRE, QUANTITECONDITIONNEMENT)
              VALUES ('" . $this->_prod_idPays . "',NULL,'" . $this->_prod_idUnite . "','" . $this->_prod_idTypeConditionnement . "','" . $this->_prod_idIngredient . "',NULL,'" . $this->_prod_quantiteConditionnement . "')";
          }
            elseif (strlen($this->_prod_idPays) == 0 && strlen($this->_prod_idMarque) == 0)
            {
              // Requête SQL
              $sql = "INSERT INTO produits (IDPAYS, IDMARQUE, IDUNITE, IDTYPECONDITIONNEMENT, IDINGREDIENT, CODEBARRE, QUANTITECONDITIONNEMENT)
                VALUES (NULL,NULL,'" . $this->_prod_idUnite . "','" . $this->_prod_idTypeConditionnement . "','" . $this->_prod_idIngredient . "',NULL,'" . $this->_prod_quantiteConditionnement . "')";
            }
              else
              {
                // Requête SQL
                $sql = "INSERT INTO produits (IDPAYS, IDMARQUE, IDUNITE, IDTYPECONDITIONNEMENT, IDINGREDIENT, CODEBARRE, QUANTITECONDITIONNEMENT)
                  VALUES ('" . $this->_prod_idPays . "','" . $this->_prod_idMarque . "','" . $this->_prod_idUnite . "','" . $this->_prod_idTypeConditionnement . "','" . $this->_prod_idIngredient . "',NULL,'" . $this->_prod_quantiteConditionnement . "')";
              }
      }
      else
      {
        if (strlen($this->_prod_idPays) == 0 && strlen($this->_prod_idMarque) > 0)
        {
          // Requête SQL
          $sql = "INSERT INTO produits (IDPAYS, IDMARQUE, IDUNITE, IDTYPECONDITIONNEMENT, IDINGREDIENT, CODEBARRE, QUANTITECONDITIONNEMENT)
            VALUES (NULL,'" . $this->_prod_idMarque . "','" . $this->_prod_idUnite . "','" . $this->_prod_idTypeConditionnement . "','" . $this->_prod_idIngredient . "','" . $this->_prod_codeBarre . "','" . $this->_prod_quantiteConditionnement . "')";
        }
          elseif (strlen($this->_prod_idPays) > 0 && strlen($this->_prod_idMarque) == 0)
          {
            // Requête SQL
            $sql = "INSERT INTO produits (IDPAYS, IDMARQUE, IDUNITE, IDTYPECONDITIONNEMENT, IDINGREDIENT, CODEBARRE, QUANTITECONDITIONNEMENT)
              VALUES ('" . $this->_prod_idPays . "',NULL,'" . $this->_prod_idUnite . "','" . $this->_prod_idTypeConditionnement . "','" . $this->_prod_idIngredient . "','" . $this->_prod_codeBarre . "','" . $this->_prod_quantiteConditionnement . "')";
          }
            elseif (strlen($this->_prod_idPays) == 0 && strlen($this->_prod_idMarque) == 0)
            {
              // Requête SQL
              $sql = "INSERT INTO produits (IDPAYS, IDMARQUE, IDUNITE, IDTYPECONDITIONNEMENT, IDINGREDIENT, CODEBARRE, QUANTITECONDITIONNEMENT)
                VALUES (NULL,NULL,'" . $this->_prod_idUnite . "','" . $this->_prod_idTypeConditionnement . "','" . $this->_prod_idIngredient . "','" . $this->_prod_codeBarre . "','" . $this->_prod_quantiteConditionnement . "')";
            }
              else
              {
                // Requête SQL
                $sql = "INSERT INTO produits (IDPAYS, IDMARQUE, IDUNITE, IDTYPECONDITIONNEMENT, IDINGREDIENT, CODEBARRE, QUANTITECONDITIONNEMENT)
                  VALUES ('" . $this->_prod_idPays . "','" . $this->_prod_idMarque . "','" . $this->_prod_idUnite . "','" . $this->_prod_idTypeConditionnement . "','" . $this->_prod_idIngredient . "','" . $this->_prod_codeBarre . "','" . $this->_prod_quantiteConditionnement . "')";
              }
      }
      // On execute la requête
      $bdd->exec($sql);
    }

    // Méthode delete
    public function delete($condition="")
    {
      $bdd = BDD::getBDD();
      // Requête SQL
      $sql = "DELETE FROM produits WHERE ".$condition;
      // On execute la requête
      $bdd->exec($sql);
    }

    // Getters
    public function get_id()
    {
      return $this->_prod_id;
    }

    public function get_idPays()
    {
      return $this->_prod_idPays;
    }

    public function get_idMarque()
    {
      return $this->_prod_idMarque;
    }

    public function get_idUnite()
    {
      return $this->_prod_idUnite;
    }

    public function get_idTypeConditionnement()
    {
      return $this->_prod_idTypeConditionnement;
    }

    public function get_idIngredient()
    {
      return $this->_prod_idIngredient;
    }

    public function get_codeBarre()
    {
      return $this->_prod_codeBarre;
    }

    public function get_quantiteConditionnement()
    {
      return $this->_prod_quantiteConditionnement;
    }

  }
?>

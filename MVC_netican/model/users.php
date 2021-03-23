<?php

  include_once 'accesBDD.php';

  class Users
  {
    // Attributs
    private $_user_username;
    private $_user_password;

    // Constructeur de la classe Users
    public function __construct($username='', $password='')
    {
      $this->_user_username = $username;
      $this->_user_password = $password;
    }

    // Méthode qui permet de connaître si username existe et password correspond
    // On met en paramètre la variable qui récupére la valeur entrée dans le formulaire
    public function identification()
    {

      // Création d'un objet à partir de la classe Fonctions du fichier 'fonctions.php'
      //$pdo = new Fonctions();
      // La variable $bdd reçoit l'autorisation de la connexion à la BDD grâce à la méthode getBDD()
      $bdd = BDD::getBDD();

      // Requête sql avec condition = si la colonne USERNAME contient la valeur de la variable $username
      $sql = "SELECT * FROM users WHERE USERNAME='".$this->_user_username."'";
      // On execute la requête
      $result = $bdd->query($sql);

      // Variable qui va nous servir si il exite un résultat de la requête sql
      $verifyIdentifiers = false;

      // Vérifie si la variable $result contient une ligne
      if ($result->rowCount() > 0)
      {
        // Récupère un tableau contenant les lignes du jeu d'enregistrements
        $data = $result->fetch();
        
        // On vérifie que le mot de passe entré correspond au mot de passe de la BDD
        if (password_verify($this->_user_password, $data['PASSWORD']))
        {
          $verifyIdentifiers = true;
        }
      }
        else
        {
          $verifyIdentifiers = false;
        }

      return $verifyIdentifiers;
    }

    // Méthode qui permet de changer les identifiants (username et password)
    public function changeIdentifiers($oldUsername, $username, $password)
    {
      $hashPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

      $sql = "UPDATE users SET USERNAME = '".$username."', PASSWORD = '".$hashPassword."' WHERE USERNAME = '".$oldUsername."'";

      $bdd = BDD::getBDD();

      $result = $bdd->query($sql);
    }

    // Méthode get username
    public function get_username()
    {
      return $this->_user_username;
    }

    // Méthode get password
    public function get_password()
    {
      return $this->_user_password;
    }
  }
?>

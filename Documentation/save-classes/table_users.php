<?php

  include_once './server/accesBDD.php';

  class Users
  {
    // Attributs
    private $_user_username;
    private $_user_password;

    // Constructeur de la classe Users
    public function __construct($username, $password)
    {
      $this->_user_username = $username;
      $this->_user_password = $password;
    }

    // Méthode qui permet de connaître si username existe et password correspond
    // On met en paramètre la variable qui récupére la valeur entrée dans le formulaire
    public function identification(): bool
    {

      // Création d'un objet à partir de la classe Fonctions du fichier 'fonctions.php'
      //$pdo = new Fonctions();
      // La variable $bdd reçoit l'autorisation de la connexion à la BDD grâce à la méthode getBDD()
      $bdd = BDD::getBDD();

      // Requête sql avec condition = si la colonne USERNAME contient la valeur de la variable $username
      $sql = "SELECT * FROM users WHERE USERNAME = '$this->_user_username' ";
      // La méthode prepare() permet de préparer la requête sql à être exécutée
      $result = $bdd->prepare($sql);
      // On execute la requête
      $result->execute();

      // Variable qui va nous servir si il exite un résultat de la requête sql
      $verifyIdentifiers = false;

      // Vérifie si la variable $result contient une ligne
      if ($result->rowCount() > 0)
      {

        // Récupère un tableau contenant les lignes du jeu d'enregistrements
        $data = $result->fetchAll();

        // On vérifie que le mot de passe entré correspond au mot de passe de la BDD
        if (password_verify($this->_user_password, $data[0]['PASSWORD']))
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
    public function changeIdentifiers($newUsername, $password, $newPassword, $confPassword)
    {
      $message = '';
      // If password correspond bien au mot de passe actuellement enregistré
      if ($password == $this->_user_password)
      {
        // If newPassword correspond bien à confPassword
        if ($newPassword == $confPassword)
        {
          $this->_user_username = $newUsername;
          $this->_user_password = $newPassword;

          $hashPassword = password_hash($this->_user_password, PASSWORD_DEFAULT, ['cost' => 14]);

          $sql = "UPDATE users SET USERNAME = '$this->_user_username', PASSWORD = '$hashPassword'";

          $bdd = BDD::getBDD();

          $result = $bdd->prepare($sql);
          $result->execute();

          $message = 'Identifiants changés';

        }
        else
        {
          $message = 'Nouveau mot de passe et confirmation du nouveau mot de passe incorrect';
        } // Fin if
      }
      else
      {
        $message = 'Mot de passe actuel incorrect';
      } // Fin if

      return $message;
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

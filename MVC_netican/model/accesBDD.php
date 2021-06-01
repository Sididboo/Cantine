<?php

  // La classe BDD sert pour la connexion à la BDD
  class BDD
  {
    // Attributs
    public static $conn = null;

    // Méthode static qui gère la conexion à la base de données
    // Retourne un objet de type PDO qui concerne la connexion à la BDD
    public static function getBDD()
    {
      // On teste si l'attribut $pdo est pas déjà initialisé sinon on l'initialise
      if (self::$conn == null)
      {
        // Identifiant
        $id = 'root';
        // Mot de passe
        $mdp = 'caribou23';
        // Nom de la BDD
        $bdd = 'cantine_ppe';
        // Adresse du serveur
        $host = 'localhost';

        /* Variable $pdo qui contient l’autorisation de la connexion à la BDD, grâce à une
        instance de la classe de base de PDO qui utilise en paramètre : le type de SGBD avec
        l’adresse du serveur (ex : host=localhost), le nom de la BDD,
        l’identifiant et le mot de passe */
        self::$conn = new PDO("mysql:host=$host;dbname=$bdd;charset=utf8",$id,$mdp,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } // Fin if
      return self::$conn;
    } // Fin méthode

  }

?>

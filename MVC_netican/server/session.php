<?php
    // Méthode qui vérifie si l'utilisateur est bien passé par la page de connexion
    function isLogged()
    {
        // On teste si il existe un tableau 'user'
        if (isset($_SESSION['user']))
        {
          return true;
        }
        else
        {
          return false;
        }
    }

    // Méthode pour la déconnection
    function isDisconnect()
    {
        session_start();
        // Vide le tableau de la session
        $_SESSION = array();
        // On détruit la session
        session_destroy();
        // On redirige l'utilisateur sur la page de connexion
        header('Location: ./index.php');
    }
?>

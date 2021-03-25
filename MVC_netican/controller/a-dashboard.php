<?php

    include_once 'model/menus.php';

    // On vérifie que le bouton 'submit' a été appuyé
    if (isset($_POST['submit']))
    {
        // On récupère dans la varibale $username la valeur entrée
        $username = htmlspecialchars($_POST['username']);
        // On récupère dans la variable $password la valeur entrée
        $password = htmlspecialchars($_POST['password']);

        // Inclut le model 'table_users.php'
        include './model/users.php';
        // On créé un objet de la classe Users
        $user = new Users($username, $password);
        
        // On verifie que l'utilisateur existe
        if ($user->identification())
        {
            // on stock le nom d'utilisateur
            $_SESSION['user'] = $username;
            
            include_once 'model/menus.php';
            // Date du jour
            $dateJour = date('d-m-y');
            /*$monBesoin = new Besoin();
            $mesBesoins = $monBesoin->findBesoins();
            */
            $etat = 'dashboard';
        }// Si c'est faux alors on redirige l'utilisateur avec le message d'erreur en methode GET
        else
        {
            header('Location: ./index.php?action=init&error=ID ou MDP incorrect, veuillez réessayer.');
        }
    }// Si l'utilisateur click sur Accueil, on vérifie que la variable SESSION contient le nom de l'utilisateur
    elseif (isset($_SESSION['user'])) 
    {

        $etat = 'dashboard';
    }// Sinon on redirige l'utilisateur vers la page de connexion
    else 
    {
        $etat = 'init';    
    }


    

?>
<?php
    // On démarre une session
    session_start();

    // On vérifie que le bouton 'submit' a été appuyé
    if (isset($_POST['submit']))
    {
        // On récupère dans la varibale $username la valeur entrée
        $username = htmlspecialchars($_POST['username']);
        // On récupère dans la variable $password la valeur entrée
        $password = htmlspecialchars($_POST['password']);

        // Inclut le fichier 'table_users.php'
        include './model/users.php';
        // On créé un objet de la classe Users
        $user = new Users($username, $password);
        
        // On verifie que l'utilisateur existe
        if ($user->identification())
        {
            // on stock le nom d'utilisateur
            $_SESSION['user'] = $username;
            // vue dashboard
            $etat = "dashboard";
        }
            else
            {
                // Si c'est faux alors on redirige l'utilisateur avec le message d'erreur en methode GET
                header('Location: ./index.php?action=init&error=ID ou MDP incorrect, veuillez réessayer.');
            }
    }
?>
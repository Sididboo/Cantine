<?php
    session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) 
    {   
        require '../model/users.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        $leUser = new Users();
        $leUser->changeIdentifiers($_SESSION['user'], $username, $password);

        echo 'Changement effectué';
    }
?>
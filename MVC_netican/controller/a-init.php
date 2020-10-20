<?php
    // Security session
    session_start();

    include './server/session.php';

    $etat;

    if (isLogged())
    {
        $etat = 'dashboard';
    }
        else
        {
            $etat = 'init';
        }
    // End Security session
?>
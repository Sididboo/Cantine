<?php
    // On lance la session ou reprend la session si déjà ouverte
    session_start();
    // On inclut le fichier session.php
    include './server/session.php';

    // On test s'il y a un paramètre GET "action"
    if ( isset($_REQUEST['action']) )
    {
        // On test si l'action est "dashboard"
        if ( $_REQUEST['action'] == 'dashboard' ) 
        {
            $action = $_REQUEST['action'];
        }// Sinon on test si l'utilisateur c'est déjà connecté (s'il click sur le boutton "Accueil")
        elseif ( isLogged() ) 
        {
            $action = $_GET['action'];
        }// Sinon on dirige l'utilisateur vers la page d'accueil
        else 
        {
            $action = 'init';
        }
    }// Sinon on dirige l'utilisateur vers la page d'accueil
    else
    {
        $action = 'init';
    }

    // Traitement de l'action
    $scriptAction = 'a-'.$action.'.php';
    include 'controller/'.$scriptAction;

    // Génération de la vue
    $scriptVue = 'v-'.$etat.'.php';
    include 'view/'.$scriptVue;
?>

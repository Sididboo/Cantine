<?php
    // *** on récupère l'action à entreprendre ***
    if (isset ($_GET['action']))
    {
        $action = $_GET['action'];
    }
        else
        {
            $action = 'init';
        }

    // *** traitement de l'action ***
    $scriptAction = 'a-'.$action.'.php';
    include 'controller/'.$scriptAction;

    // *** génération de la vue ***
    $scriptVue = 'v-'.$etat.'.php';
    include 'view/'.$scriptVue;
?>

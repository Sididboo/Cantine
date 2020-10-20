<?php
    // Security session
    session_start();

    include './server/session.php';

    include_once './modele/produitsAchetes.php';
    include_once './modele/categoriesIngredients.php';
    include_once './modele/marques.php';
    include_once './modele/pays.php';
    include_once './modele/typesConditionnements.php';
    include_once './modele/unites.php';

    $etat;

    if (isset($_REQUEST['idTicket']) && isLogged()) 
    {
        $produitsAchetes = new ProduitsAchetes();
        $listProduitsAchetes = array();
        $listProduitsAchetes = $produitsAchetes->findBy($_REQUEST['idTicket']);

        $categoriesIngredients = new CategoriesIngredients();
        $listCategoriesIngredients = array();
        $listCategoriesIngredients = $categoriesIngredients->findAll();

        $marques = new Marques();
        $listMarques = array();
        $listMarques = $marques->findAll();

        $pays = new Pays();
        $listPays = array();
        $listPays = $pays->findAll();

        $typesConditionnements = new TypesConditionnements();
        $listTypesConditionnements = array();
        $listTypesConditionnements = $typesConditionnements->findAll();

        $unites = new Unites();
        $listUnites = array();
        $listUnites = $unites->findAll();

        $etat = 'articles';
    }
        else
        {
            $etat = 'init';
        }
?>
<?php
    // Security session
    session_start();

    include './server/session.php';

    include_once 'model/produitsAchetes.php';
    include_once 'model/categoriesIngredients.php';
    include_once 'model/marques.php';
    include_once 'model/pays.php';
    include_once 'model/typesConditionnements.php';
    include_once 'model/unites.php';

    $etat;

    if (isset($_REQUEST['idTicket']) && isLogged()) 
    {
        $_SESSION['idTicket'] = $_REQUEST['idTicket'];

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
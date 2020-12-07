<?php
    // On vérifie qu'il y a l'idTicket passé en méthode GET
    if (isset($_REQUEST['idTicket'])) 
    {
        // On inclut les classes :
        include_once 'model/produitsAchetes.php';
        include_once 'model/categoriesIngredients.php';
        include_once 'model/marques.php';
        include_once 'model/pays.php';
        include_once 'model/typesConditionnements.php';
        include_once 'model/unites.php';

        // On met en variable de session l'id ticket
        $_SESSION['idTicket'] = $_REQUEST['idTicket'];

        // On récupère les listes des classes concernées
        $produitsAchetes = new ProduitsAchetes();
        $listProduitsAchetes = array();
        $listProduitsAchetes = $produitsAchetes->findByTicket($_REQUEST['idTicket']);

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
?>
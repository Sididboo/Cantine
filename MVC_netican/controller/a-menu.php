<?php  

    include_once 'model/categoriesPlats.php';
    include_once 'model/plats.php';
    include_once 'model/menus.php';
    include_once 'model/contient.php';

    // liste catégories 
    $listCategoriesPlats = array();
    // liste plats
    $listPlats = array();
    // liste menus
    $listMenus = array();

    $categoriesPlats = new CategoriesPlats();
    $listCategoriesPlats = $categoriesPlats->findAll();

    // $plats= new Plats();
    // $listPlats = $plats->findAll();

    // $menus = new Menus();
    // $listMenus = $menus->findAll();

    $contient = new Contient();
    $listContenants = $contient->findAll();
    

    $etat;

    if (isLogged())
    {
        $etat = 'menus';
    }
        else
        {
            $etat = 'init';
        }
?>
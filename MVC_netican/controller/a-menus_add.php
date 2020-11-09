<?php
    include_once '../model/menus.php';
    include_once '../model/categoriesPlats.php';
    include_once '../model/plats.php';

    $date = $_REQUEST['dateMenu'];

    $laCategorie = new CategoriesPlats();
    $laCategorie->retrieve($_REQUEST['categoriePlat']);

    $lePlat = new Plats();
    $lePlat->retrieve($_REQUEST['plats']);
    
    $leMenu = new Menus($dateMenu, $nbConvive);
    $leMenu->create();

    

    $listMenus = array();
    $listMenus = $leMenu->findAll();

    for ($i=0; $i < count($listMenus); $i++) 
    {
        ?>
            <tr>
                <td><?php echo $listMenus[$i]->get_dateMenus(); ?></td>
                <td><?php echo $listMenus[$i]->get_nbConvives(); ?></td>
            </tr>
        <?php
    }

?>
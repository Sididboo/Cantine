<?php
    include_once '../model/menus.php';
    include_once '../model/plats.php';
    include_once '../model/contient.php';

    if (isset($_REQUEST['nbConvive']) && isset($_REQUEST['dateMenu']) &&  isset($_REQUEST['plat']) ) {
        # code...
        $lePlat = new Plats();
        $lePlat->retrieve($_REQUEST['plat']);
        
        $leMenu = new Menus($_REQUEST['dateMenu'], $_REQUEST['nbConvive']);
        $leMenu->create();

        $contient = new Contient($leMenu,$lePlat);
        $contient->create();

        $listContenants = $contient->findAll();

    
        for ($i=0; $i < count($listContenants); $i++) 
        {
            ?>
                <tr>
                <td><?php echo $listContenants[$i]->get_leMenu()->get_dateMenu(); ?></td>
                <td><?php echo $listContenants[$i]->get_leMenu()->get_nbConvive(); ?></td>
                <td><?php echo $listContenants[$i]->get_lePlat()->get_nom(); ?></td>
                </tr>
            <?php
        }
    }


?>
<?php
    // On récupère la session en cours
    session_start();
    
    // On vérifie qu'il y a un paramètre GET de nom "dateMenu"
     if (isset($_REQUEST['dateMenu']) && isset($_REQUEST['idplat'])) 
    {
         
        // On inclut les classes :
        include_once '../model/categoriesPlats.php';
        include_once '../model/plats.php';
        include_once '../model/menus.php';
        include_once '../model/contient.php';

        // On créé un objet Contient et on le renseigne avec dateMenu qui est en paramètre GET
        $leContenant = new Contient();
        $leContenant->retrieve($_REQUEST['dateMenu'],$_REQUEST['idplat']);
        $leContenant->delete();
        $lesContenants = $leContenant->findAllByDateMenu($_REQUEST['dateMenu']);
        if (count($lesContenants)<1)
        {
            // On créé un objet Menu et on le renseigne avec dateMenu qui est en paramètre GET
            $leMenu = new Menus();
            $leMenu->retrieve($_REQUEST['dateMenu']);
        }  
            // Liste Menus
            $listContenants = array();
            $listContenants = $leContenant->findAll();

            // On parcours la liste pour créé les lignes du tableau
            for ($i=0; $i < count($listContenants); $i++) 
            { 
                ?>
                    <tr>
                        <td><?php echo $listContenants[$i]->get_leMenu()->get_dateMenu(); ?></td>
                        <td><?php echo $listContenants[$i]->get_leMenu()->get_nbConvive(); ?></td>
                        <td><?php echo $listContenants[$i]->get_lePlat()->get_nom(); ?></td>
                        <td class="actions">
                        <button class="buttonItemExit" onclick="delMenus('<?= $listContenants[$i]->get_leMenu()->get_dateMenu() ?>', <?= $listContenants[$i]->get_lePlat()->get_id() ?>)"><i class="fas fa-trash"></i> Supprimer</button>
                    </td>
                    </tr>
                <?php
            }
        
    }
?>

<?php
    // On récupère la session en cours
    session_start();
    
    // On vérifie qu'il y a un paramètre GET de nom "dateMenu"
     if (isset($_REQUEST['dateMenu'])) 
    {
         
        // On inclut les classes :
        include_once '../model/categoriesPlats.php';
        include_once '../model/plats.php';
        include_once '../model/menus.php';
        include_once '../model/contient.php';

         // On créé un objet Contient et on le renseigne avec dateMenu qui est en paramètre GET
         $leContenant = new Contient();
         $lesContenants = $leContenant->findAllByDateMenu($_REQUEST['dateMenu']);

        // On créé un objet Menu et on le renseigne avec dateMenu qui est en paramètre GET
        $leMenu = new Menus();
        $leMenu->retrieve($_REQUEST['dateMenu']);

        // isDelete servira à savoir si une erreur empeche de supprimer le menu
        $isDelete = true;

        // On essaye de supprimer le menu
        try 
        {
            for ($i=0; $i <count ($lesContenants); $i++)
            {
                $lesContenants[$i]->delete();
            }
             $leMenu->delete();
        } // En cas d'erreur, on met la variable isDelete à false et 
         // on affiche "0" pour qu'ensuite le fichier JS fasse en fonction de la réponse qu'il recoit
        catch (Exception $e) 
        {
             echo '0';
             $isDelete = false;
        }
        // Si la variable isDelete est true
        if ($isDelete) 
        {
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
                        <button class="buttonItemExit" onclick="delMenus('<?php echo $listContenants[$i]->get_leMenu()->get_dateMenu(); ?>')"><i class="fas fa-trash"></i> Supprimer</button>
                    </td>
                    </tr>
                <?php
            }
        }
    }
?>

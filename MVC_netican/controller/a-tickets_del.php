<?php
    // On vérifie qu'il y a un paramètre GET de nom "idTicket"
    if (isset($_REQUEST['idTicket'])) 
    {
        // On inclut les classes :
        include_once '../model/tickets.php';
        include_once '../model/produitsAchetes.php';

        // On créé un objet Tickets et on le renseigne avec idTicket qui est en paramètre GET
        $leTicket = new Tickets();
        $leTicket->retrieve($_REQUEST['idTicket']);

        // isDelete servira à savoir si une erreur empeche de supprimer le ticket
        $isDelete = true;

        // On essaye de supprimer le ticket
        try 
        {
            $leTicket->delete();
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
            // On test si le ticket à une piece jointe
            if (strlen($leTicket->get_pieceJointe()) > 0) 
            {
                // Sélection du fichier à supprimer
                $path = "../server/imgs_tickets/" . $leTicket->get_pieceJointe();

                // Suppresion du fichier
                unlink($path);
            }

            // Liste tickets
            $listTickets = array();
            $listTickets = $leTicket->findAll();

            // On parcours la liste pour créé les lignes du tableau
            for ($i=0; $i < count($listTickets); $i++) 
            { 
                ?>
                    <tr>
                        <td><?php echo $listTickets[$i]->get_dateTicket(); ?></td>
                        <td><?php echo $listTickets[$i]->get_leCommerce()->get_nom(); ?></td>
                        <td><?php echo $listTickets[$i]->get_laCategorie()->get_nom(); ?></td>
                        <td>
                            <?php 
                                if($listTickets[$i]->get_pieceJointe() != NULL)
                                {
                                    echo $listTickets[$i]->get_pieceJointe();
                                }
                                else
                                {
                                    ?>
                                        <div>
                                            
                                            <input class="buttonFile" type="file" name="file" id="file"/>
                                        </div>
                                        <div>
                                            <button class="buttonUpload" type="button" name="upload" onclick="upload(<?php echo $listTickets[$i]->get_id(); ?>)">Upload</button>
                                        </div>
                                    <?php
                                }
                            ?>
                        </td>
                        <td class="actions">
                            <button class="buttonItemExit" onclick="delTicket('<?php echo $listTickets[$i]->get_id(); ?>')"><i class="fas fa-trash"></i> Supprimer</button>
                            <a href="./index.php?action=articles&idTicket=<?php echo $listTickets[$i]->get_id(); ?>"><button class="buttonAddArticle"><i class="fas fa-plus"></i> Ajouter articles</button></a>
                        </td>
                    </tr>
                <?php
            }
        }
    }
?>
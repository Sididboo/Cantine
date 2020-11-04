<?php
    if (isset($_REQUEST['idTicket'])) 
    {
        include_once '../model/tickets.php';
        include_once '../model/produitsAchetes.php';

        $leTicket = new Tickets();
        $leTicket->retrieve($_REQUEST['idTicket']);

        // isDelete servira à savoir si une erreur empeche de supprimer le ticket
        $isDelete = true;

        // On essaye de supprimer le ticket
        try 
        {
            $leTicket->delete();
        } // En cas d'erreur, on ne fait rien
        catch (\Throwable $th) 
        {
            echo '0';
            $isDelete = false;
        }

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

            $listTickets = array();
            $listTickets = $leTicket->findAll();

            for ($i=0; $i < count($listTickets); $i++) 
            { 
                ?>
                    <tr>
                        <td><?php echo $listTickets[$i]->get_dateTicket(); ?></td>
                        <td><?php echo $listTickets[$i]->get_leCommerce()->get_nom(); ?></td>
                        <td><?php echo $listTickets[$i]->get_laCategorie()->get_nom(); ?></td>

                        <?php
                            if($listTickets[$i]->get_pieceJointe() != NULL)
                                {
                                    ?>
                                        <td><?php echo $listTickets[$i]->get_pieceJointe(); ?></td>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <td>
                                            <div>
                                                <input type="file" name="file" id="file"/>
                                            </div>
                                            <div>
                                                <button type="button" name="upload" onclick="upload(<?php echo $listTickets[$i]->get_id(); ?>)">Upload</button>
                                            </div>
                                        </td>
                                    <?php
                                }
                        ?>

                        <td>
                            <button class="btn btn-primary" onclick="delTicket(<?php echo $listTickets[$i]->get_id(); ?>)"><i class="fas fa-trash"></i> Supprimer</button>
                            <a href="./index.php?action=articles&idTicket=<?php echo $listTickets[$i]->get_id(); ?>"><button class="btn btn-secondary"><i class="fas fa-plus"></i> Ajouter articles</button></a>
                        </td>
                    </tr>
                <?php
            }
        }
    }
?>
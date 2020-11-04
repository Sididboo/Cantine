<?php
    include_once '../model/tickets.php';
    include_once '../model/categoriesTickets.php';
    include_once '../model/commerces.php';

    $date = $_REQUEST['date'];

    $laCategorie = new CategoriesTickets();
    $laCategorie->retrieve($_REQUEST['categorie']);

    $leCommerce = new Commerces();
    $leCommerce->retrieve($_REQUEST['commerce']);

    $leTicket = new Tickets('', $laCategorie, $leCommerce, $date, NULL);
    
    $leTicket->create();

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
?>
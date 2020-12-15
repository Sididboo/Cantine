<?php
    // On inclut les classes :
    include_once '../model/tickets.php';
    include_once '../model/categoriesTickets.php';
    include_once '../model/commerces.php';

    // On renseigne les objets suivant avec les données du formulaire
    $laCategorie = new CategoriesTickets();
    $laCategorie->retrieve($_REQUEST['categorie']);

    $leCommerce = new Commerces();
    $leCommerce->retrieve($_REQUEST['commerce']);

    $leTicket = new Tickets('', $laCategorie, $leCommerce, $_REQUEST['date'], NULL);
    // On créé le ticket
    $leTicket->create();

    // liste des tickets
    $listTickets = array();
    // On récupère la liste avec findAll()
    $listTickets = $leTicket->findAll();

    // On parcours la liste pour générer les lignes du tableau
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
?>
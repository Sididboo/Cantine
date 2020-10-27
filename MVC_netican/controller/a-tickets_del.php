<?php
    include_once '../model/tickets.php';

    $leTicket = new Tickets();
    $leTicket->retrieve($_REQUEST['idTicket']);

    /*// Sélection du fichier à supprimer
    $path = "../server/imgs_tickets/" . $leTicket->get_pieceJointe();

    // Suppresion du fichier
    unlink($path);*/

    $leTicket->delete();

    $listTickets = array();
    $listTickets = $leTicket->findAll();

    for ($i=0; $i < count($listTickets); $i++) 
    { 
        echo '<tr>';
            echo '<td>'.$listTickets[$i]->get_dateTicket().'</td>';
            echo '<td>'.$listTickets[$i]->get_leCommerce()->get_nom().'</td>';
            echo '<td>'.$listTickets[$i]->get_laCategorie()->get_nom().'</td>';
            if($listTickets[$i]->get_pieceJointe() != NULL)
                {
                    echo '<td>'.$listTickets[$i]->get_pieceJointe().'</td>';
                }
                    else
                    {
                        echo '<td>';
                            echo '<form action="constroller/a-tickets_upload.php" method="POST" enctype="multipart/form-data">';
                                echo '<div>';
                                    echo '<input type="file" name="file" id="file"/>';
                                echo '</div>';
                                echo '<div>';
                                    echo '<input type="submit" name="submit" value="Upload"/>';
                                echo '</div>';
                            echo '</form>';
                        echo '</td>';
                    }
            echo '<td>';
                echo '<button class="btn btn-primary" onclick="delTicket('.$listTickets[$i]->get_id().')"><i class="fas fa-trash"></i> Supprimer</button>';
                echo '<a href="./index.php?action=articles&idTicket='.$listTickets[$i]->get_id().'"><button class="btn btn-secondary"><i class="fas fa-plus"></i> Ajouter articles</button></a>';
            echo '</td>';
        echo '</tr>';
    }
?>
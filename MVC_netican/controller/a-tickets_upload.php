<?php
    if (isset($_FILES['file']) && isset($_REQUEST['idTicket'])) 
    {
        include_once '../model/tickets.php';

        $file = $_FILES['file']['name'];

        move_uploaded_file($_FILES['file']["tmp_name"], "../server/imgs_tickets/" . $file);

        $leTicket = new Tickets();
        $leTicket->retrieve($_REQUEST['idTicket']);

        $leTicket->update($file);

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
                                echo '<input type="file" name="file" id="file" onchange="upload()">';
                            echo '</td>';
                        }
                echo '<td>';
                    echo '<button class="btn btn-primary" onclick="delTicket('.$listTickets[$i]->get_id().')"><i class="fas fa-trash"></i> Supprimer</button>';
                    echo '<a href="./index.php?action=articles&idTicket='.$listTickets[$i]->get_id().'"><button class="btn btn-secondary"><i class="fas fa-plus"></i> Ajouter articles</button></a>';
                echo '</td>';
            echo '</tr>';
        }
    }
?>
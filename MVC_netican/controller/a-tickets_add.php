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
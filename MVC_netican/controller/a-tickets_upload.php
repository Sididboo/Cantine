<?php
    if (isset($_FILES['file']) && isset($_REQUEST['idTicket'])) 
    {
        include_once '../model/tickets.php';

        // Vérification de l'image et upload
        $isImage = true;

        $target_dir = "../server/imgs_tickets/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $file = $_FILES['file']['name'];

        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check === false)
        {
            echo "1";
            $isImage = false;
        }

        // Check if file already exists
        if (file_exists($target_file) && $isImage != false)
        {
            echo "2";
            $isImage = false;
        }
        // Check file size
        if ($_FILES["file"]["size"] > 500000 && $isImage != false)
        {
            echo "3";
            $isImage = false;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $isImage != false)
        {
            echo "4";
            $isImage = false;
        }

        // Si $isImage est true alors on upload et met à jour le ticket
        if ($isImage) 
        {
            move_uploaded_file($_FILES['file']["tmp_name"], $target_dir . $file);

            $leTicket = new Tickets();
            $leTicket->retrieve($_REQUEST['idTicket']);

            $leTicket->update($file);

            // Affichage balises option
            $listTickets = array();
            $listTickets = $leTicket->findAll();

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
                                            <input type="file" name="file" id="file"/>
                                        </div>
                                        <div>
                                            <button type="button" name="upload" onclick="upload(<?php echo $listTickets[$i]->get_id(); ?>)">Upload</button>
                                        </div>
                                    <?php
                                }
                            ?>
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="delTicket('<?php echo $listTickets[$i]->get_id(); ?>')"><i class="fas fa-trash"></i> Supprimer</button>
                            <a href="./index.php?action=articles&idTicket=<?php echo $listTickets[$i]->get_id(); ?>"><button class="btn btn-secondary"><i class="fas fa-plus"></i> Ajouter articles</button></a>
                        </td>
                    </tr>
                <?php
            }
        }
    }
?>
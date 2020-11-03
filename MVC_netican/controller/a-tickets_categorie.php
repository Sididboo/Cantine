<?php
    if (isset($_REQUEST['categorie'])) 
    {
        include_once '../model/categoriesTickets.php';

        $listCategoriesTickets = array();

        // Vérification si catégorie existe
        $laCategorieTicket = new CategoriesTickets();
        $laCategorieTicket->retrieveByName($_REQUEST['categorie']);

        if ($laCategorieTicket->get_id() == 0) 
        {
            $laCategorieTicket = new CategoriesTickets("", $_REQUEST['categorie']);
            $laCategorieTicket->create();
        }

        // Affichage balises option
        $listCategoriesTickets = $laCategorieTicket->findAll();
        
        for ($i=0; $i < count($listCategoriesTickets); $i++) 
        {
            if ($listCategoriesTickets[$i]->get_nom() == $_REQUEST['categorie']) 
            {
                ?>
                    <option value="<?php echo $listCategoriesTickets[$i]->get_id(); ?>" selected><?php echo $listCategoriesTickets[$i]->get_nom(); ?></option>
                <?php
            }
            else
            {
                ?>
                    <option value="<?php echo $listCategoriesTickets[$i]->get_id(); ?>"><?php echo $listCategoriesTickets[$i]->get_nom(); ?></option>
                <?php
            }
        }
    }
?>
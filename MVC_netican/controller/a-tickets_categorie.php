<?php
    // On vérifie qu'il y a un paramètre GET de nom "categorie"
    if (isset($_REQUEST['categorie'])) 
    {
        // On inclut la classe :
        include_once '../model/categoriesTickets.php';

        // liste catégories ticket
        $listCategoriesTickets = array();

        // On créé un objet CategoriesTickets et on recherche le nom
        $laCategorieTicket = new CategoriesTickets();
        $laCategorieTicket->retrieveByName($_REQUEST['categorie']);

        // Si le nom de la catégorie n'existe pas
        if ($laCategorieTicket->get_id() < 1) 
        {
            // On créé la catégorie du ticket
            $laCategorieTicket = new CategoriesTickets("", $_REQUEST['categorie']);
            $laCategorieTicket->create();
            // On recherche le dernier enregistrement
            $laCategorieTicket->retrieveLast();
        }

        // On récupère la liste des catégorie ticket avec findAll()
        $listCategoriesTickets = $laCategorieTicket->findAll();
        
        // On parcours la liste pour remplir la liste déroulante
        for ($i=0; $i < count($listCategoriesTickets); $i++) 
        {
            // Si on tombe sur la catégorie du ticket précédemment créé, 
            // on le selection par défaut dans la liste déroulante
            if ($listCategoriesTickets[$i]->get_id() == $laCategorieTicket->get_id()) 
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
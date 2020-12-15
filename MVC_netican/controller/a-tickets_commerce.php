<?php
    // On vérifie qu'il y a un paramètre GET de nom "commerce"
    if (isset($_REQUEST['commerce'])) 
    {
        // On inclut la classe :
        include_once '../model/commerces.php';

        // liste commerces
        $listCommerces = array();

        // On créé un objet Commerces et on recherche le nom
        $leCommerce = new Commerces();
        $leCommerce->retrieveByName($_REQUEST['commerce']);

        // Si le nom de la catégorie n'existe pas
        if ($leCommerce->get_id() < 1) 
        {
            // On créé le commerce
            $leCommerce = new Commerces("", $_REQUEST['commerce']);
            $leCommerce->create();
            // On recherche le dernier enregistrement
            $leCommerce->retrieveLast();
        }

        // Liste des commerces
        $listCommerces = $leCommerce->findAll();
        
        // Parcours de la liste pour remplir la liste déroulante
        for ($i=0; $i < count($listCommerces); $i++) 
        { 
            // Si on tombe sur la commerce précédemment créé, 
            // on le selection par défaut dans la liste déroulante
            if ($listCommerces[$i]->get_id() == $leCommerce->get_id()) 
            {
                ?>
                    <option value="<?php echo $listCommerces[$i]->get_id(); ?>" selected><?php echo $listCommerces[$i]->get_nom(); ?></option>
                <?php
            }
            else
            {
                ?>
                    <option value="<?php echo $listCommerces[$i]->get_id(); ?>"><?php echo $listCommerces[$i]->get_nom(); ?></option>
                <?php
            }
        }
    }
?>
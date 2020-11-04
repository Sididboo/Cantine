<?php
    if (isset($_REQUEST['commerce'])) 
    {
        include_once '../model/commerces.php';

        $listCommerces = array();

        // Vérification si commerce existe
        $leCommerce = new Commerces();
        $leCommerce->retrieveByName($_REQUEST['commerce']);

        if (strlen($leCommerce->get_id()) == 0) 
        {
            $leCommerce = new Commerces("", $_REQUEST['commerce']);
            $leCommerce->create();
        }

        // Affichage balises option
        $listCommerces = $leCommerce->findAll();
        
        for ($i=0; $i < count($listCommerces); $i++) 
        { 
            if ($listCommerces[$i]->get_nom() == $_REQUEST['commerce']) 
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
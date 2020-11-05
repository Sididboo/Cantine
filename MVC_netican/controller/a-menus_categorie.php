<?php
    if (isset($_REQUEST['categorie'])) 
    {
        include_once '../model/categoriesPlats.php';

        $listCategoriesPlats = array();

        // Vérification si catégorie existe
        $listCategoriesPlats = new CategoriesPlats();
        $listCategoriesPlats->retrieveByName($_REQUEST['categorie']);

        if ($laCategoriePlat->get_id() == 0) 
        {
            $listCategoriesPlats = new CategoriePlat("", $_REQUEST['categorie']);
            $listCategoriesPlats->create();
        }

        // Affichage balises option
        $listCategoriesPlats = $laCategoriePlat->findAll();
        
        for ($i=0; $i < count($listCategoriesPlats); $i++) 
        {
            if ($listCategoriesPlats[$i]->get_nom() == $_REQUEST['categorie']) 
            {
                ?>
                    <option value="<?php echo $listCategoriesPlats[$i]->get_id(); ?>" selected><?php echo $listCategoriesPlats[$i]->get_nom(); ?></option>
                <?php
            }
            else
            {
                ?>
                    <option value="<?php echo $listCategoriesPlats[$i]->get_id(); ?>"><?php echo $listCategoriesPlats[$i]->get_nom(); ?></option>
                <?php
            }
        }
    }
?>
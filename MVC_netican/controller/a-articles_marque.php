<?php
    // On vérifie qu'il y a la marque en méthode GET
    if (isset($_REQUEST['marque'])) 
    {
        // On inclut la classe :
        include_once '../model/marques.php';

        // Liste des marques
        $listMarques = array();

        // On créé un objet Marques et on recherche le nom
        $laMarque = new Marques();
        $laMarque->retrieveByName($_REQUEST['marque']);

        if ($laMarque->get_id() < 1) 
        {
            $laMarque = new Marques('', $_REQUEST['marque']);
            // On créé la marque 
            $laMarque->create();
            // On recherche le dernier enregistrement
            $laMarque->retrieveLast();
        }

        // On renseigne la liste
        $listMarques = $laMarque->findAll();

        //On parcours la liste pour générer les balises option
        for ($i=0; $i < count($listMarques); $i++) 
        { 
            if ($laMarque->get_id() == $listMarques[$i]->get_id()) 
            {
                echo '<option value="'.$laMarque->get_id().'" selected>'.$laMarque->get_nom().'</option>';
            }
            else
            {
                echo '<option value="'.$listMarques[$i]->get_id().'">'.$listMarques[$i]->get_nom().'</option>';
            }
        }
    }
?>